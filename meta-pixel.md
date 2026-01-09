# Meta Pixel and Conversion API Implementation Plan

## Overview
Implement Meta (Facebook) Pixel for frontend tracking and Conversion API for server-side event tracking with deduplication support.

## Events to Track
1. **Lead** - Quote form submission (Pixel + CAPI with deduplication)
2. **PageView** - All page views (Pixel only)
3. **ViewContent** - Blog post views (Pixel only)
4. **Contact** - Quote modal opens (Pixel only)
5. **InitiateCheckout** - "Get a Quote" CTA button clicks (Pixel only)

## Implementation Steps

### Phase 1: Configuration Setup

#### 1.1 Environment Variables
**Files:** `.env.example`, `.env`

Add to `.env.example`:
```bash
# Meta Pixel and Conversion API
VITE_META_PIXEL_ID=
META_ACCESS_TOKEN=
META_API_VERSION=v21.0
```

Add actual values to `.env`.

#### 1.2 Services Configuration
**File:** `/home/andru/Projects/seova/config/services.php`

Add after existing services (around line 44):
```php
'meta' => [
    'pixel_id' => env('VITE_META_PIXEL_ID'),
    'access_token' => env('META_ACCESS_TOKEN'),
    'api_version' => env('META_API_VERSION', 'v21.0'),
    'endpoint' => 'https://graph.facebook.com',
],
```

---

### Phase 2: Frontend - Meta Pixel Integration

#### 2.1 Add Meta Pixel Base Code
**File:** `/home/andru/Projects/seova/resources/views/layouts/app.blade.php`

Add after Google Analytics block (after line 64, before `</head>`):
```blade
<!-- Meta Pixel Code -->
@if(env('VITE_META_PIXEL_ID'))
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '{{ env('VITE_META_PIXEL_ID') }}');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id={{ env('VITE_META_PIXEL_ID') }}&ev=PageView&noscript=1"
/></noscript>
@endif
```

#### 2.2 Extend Analytics.js for Dual Tracking
**File:** `/home/andru/Projects/seova/resources/js/analytics.js`

Replace `initAnalytics()` function (lines 8-30) to add:
- `mapToMetaEvent()` method - Maps custom events to Meta standard events
- Updated `track()` method - Sends to both GA and Meta Pixel
- `generateEventID()` method - Creates unique IDs for deduplication
- Support for eventID in options parameter

Event mappings:
- `quote_form_submit` → `Lead`
- `quote_modal_open` → `Contact`
- `hero_cta_quote`, `nav_cta_quote` → `InitiateCheckout`

Update `fireAnalytics()` to accept `options` parameter for eventID.

#### 2.3 Blog Post ViewContent Tracking
**File:** `/home/andru/Projects/seova/resources/views/blog/show.blade.php`

Add after line 13 (in `@section('json-ld')`):
```blade
@if(env('VITE_META_PIXEL_ID'))
<script>
if (window.fbq) {
    fbq('track', 'ViewContent', {
        content_name: @json($post->title),
        content_category: 'Blog Post',
        content_ids: [@json($post->id)],
        content_type: 'product'
    });
}
</script>
@endif
```

#### 2.4 Quote Modal Event Deduplication
**File:** `/home/andru/Projects/seova/resources/js/quote-modal.js`

Update form submit event listener (line 193) to:
1. Generate unique eventID using `window.SeovaAnalytics.generateEventID()`
2. Create hidden input field `meta_event_id` with the eventID
3. Pass eventID to `fireAnalytics('quote_form_submit', e, {}, { eventID })`

This ensures same eventID goes to both Pixel (frontend) and CAPI (backend).

#### 2.5 Main Quote Form Event ID
**File:** `/home/andru/Projects/seova/resources/views/partials/quote-form.blade.php`

Add `@push('scripts')` block at end to handle eventID generation for main contact form (mirrors modal approach).

---

### Phase 3: Backend - Meta Conversion API Integration

#### 3.1 Create MetaConversionService
**File to create:** `/home/andru/Projects/seova/app/Services/MetaConversionService.php`

Implement service with:
- Constructor: Load config from `config('services.meta.*')`
- `sendEvent()`: Core method to send events to Meta CAPI
  - Validates configuration
  - Processes user data (hashes PII)
  - Makes HTTP POST to `https://graph.facebook.com/{version}/{pixel_id}/events`
  - Returns `['ok' => bool, 'response' => array, 'error' => string]`
- `processUserData()`: Hash email/name with SHA-256, include IP/UA unhashed
- `hashData()`: Normalize (trim, lowercase) then SHA-256 hash
- `sendLeadEvent()`: Convenience method for quote submissions
  - Splits name into first/last
  - Formats user data
  - Calls `sendEvent('Lead', ...)`

Uses `Illuminate\Support\Facades\Http` for API calls (10s timeout).
Comprehensive error handling with logging at INFO/WARNING/ERROR levels.

#### 3.2 Update QuoteController
**File:** `/home/andru/Projects/seova/app/Http/Controllers/QuoteController.php`

Changes:
1. Add `MetaConversionService` to constructor dependency injection
2. In `store()` method validation, add `'meta_event_id' => ['nullable', 'string', 'max:100']`
3. After successful `$this->quoteService->submitQuote()`:
   - Capture `meta_event_id` from validated data
   - Call `$this->metaConversionService->sendLeadEvent()` with name, email, IP, UA, referer, eventID
   - Wrap in try-catch - log errors but don't fail quote submission
4. Exclude `meta_event_id` from `withInput()` on error

---

### Phase 4: Testing & Verification

#### Frontend Testing
1. Check Meta Pixel loads (DevTools → Network → filter "fbevents")
2. Verify PageView fires on all pages
3. Test Lead event on form submission (with eventID)
4. Test Contact event on modal open (with source parameter)
5. Test ViewContent on blog posts
6. Test InitiateCheckout on CTA clicks
7. Verify Google Analytics still works (backward compatibility)

#### Backend Testing
1. Submit quote form, check Laravel logs for CAPI request
2. Verify eventID matches between frontend and backend logs
3. Test with missing credentials (should log warning, not fail)
4. Verify quote submission succeeds even if Meta API fails
5. Check PII is hashed in logs

#### Deduplication Testing
1. Submit quote form
2. Check browser console for Pixel event with eventID
3. Check Laravel logs for CAPI event with same eventID
4. Check Meta Events Manager - should show 1 deduplicated Lead event

**Tools:**
- Meta Events Manager: https://business.facebook.com/events_manager2/
- Meta Pixel Helper (Chrome extension)
- Meta Test Events API

---

## Event Mapping Summary

| User Action | Custom Event | Meta Event | Source |
|-------------|--------------|------------|--------|
| Quote form submitted | `quote_form_submit` | **Lead** (Pixel + CAPI) | analytics.js + QuoteController |
| Quote modal opened | `quote_modal_open` | **Contact** | analytics.js |
| Blog post viewed | N/A | **ViewContent** | blog/show.blade.php |
| Get Quote CTA clicked | `nav_cta_quote`, `hero_cta_quote` | **InitiateCheckout** | analytics.js |
| All page views | N/A | **PageView** | app.blade.php |

---

## Critical Files

**Frontend:**
- `/home/andru/Projects/seova/resources/views/layouts/app.blade.php` - Add Pixel code
- `/home/andru/Projects/seova/resources/js/analytics.js` - Extend for Meta tracking
- `/home/andru/Projects/seova/resources/js/quote-modal.js` - Add eventID generation
- `/home/andru/Projects/seova/resources/views/partials/quote-form.blade.php` - Add eventID script
- `/home/andru/Projects/seova/resources/views/blog/show.blade.php` - Add ViewContent tracking

**Backend:**
- `/home/andru/Projects/seova/app/Services/MetaConversionService.php` - **NEW FILE** - CAPI service
- `/home/andru/Projects/seova/app/Http/Controllers/QuoteController.php` - Trigger CAPI calls
- `/home/andru/Projects/seova/config/services.php` - Add Meta config

**Configuration:**
- `/home/andru/Projects/seova/.env.example` - Add Meta env vars
- `/home/andru/Projects/seova/.env` - Add actual credentials

---

## Error Handling Strategy

1. **Frontend:** All analytics wrapped in try-catch (already exists), never break UX
2. **Backend:** Meta CAPI failures logged but don't fail quote submission
3. **Configuration:** Missing credentials logged with warning, graceful degradation
4. **Logging:** Use `[Meta Conversion API]` prefix for easy log filtering

---

## Data Privacy Notes

- Email and name hashed with SHA-256 before sending to CAPI (Meta requirement)
- IP address and user agent sent unhashed (Meta requirement for matching)
- Update Privacy Policy to disclose Meta Pixel tracking
- Consider cookie consent banner (future enhancement)

---

## Rollback Plan

1. Quick disable: Empty `VITE_META_PIXEL_ID` and `META_ACCESS_TOKEN` in `.env`
2. Remove backend: Comment out `metaConversionService` call in QuoteController
3. Remove frontend: Comment out Pixel code in app.blade.php
4. Full rollback: Git revert

---

## Implementation Order

1. **Day 1:** Configuration (Phase 1) + Pixel base code (Task 2.1) - Test PageView
2. **Day 2:** Frontend tracking (Tasks 2.2, 2.3) - Test all Pixel events
3. **Day 3:** Event deduplication (Tasks 2.4, 2.5) - Test eventID generation
4. **Day 4:** Backend CAPI (Phase 3) - Test Lead event server-side
5. **Day 5:** End-to-end testing (Phase 4) - Verify deduplication
