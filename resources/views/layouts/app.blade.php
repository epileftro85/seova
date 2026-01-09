<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Seova – SEO Virtual Assistant')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Seova is your SEO Virtual Assistant. Get technical SEO audits, keyword strategy, and data-driven insights to grow your business organically.')">
    <meta name="keywords" content="@yield('keywords', 'SEO, search engine optimization, virtual assistant, keyword research, technical SEO, site audit, SEO tools')">
    <meta name="author" content="Seova SEO Assistant">
    <meta name="robots" content="@yield('robots', 'index,follow,max-image-preview:large')">
    <meta name="theme-color" content="#0f172a" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', 'Seova – SEO Virtual Assistant')">
    <meta property="og:description" content="@yield('og_description', 'Smart SEO solutions for small businesses. Technical expertise and data analysis to help you grow organically.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('img/seova-og-image.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Seova">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Seova – SEO Virtual Assistant')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Smart SEO solutions for small businesses. Get technical expertise and data analysis.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('img/seova-twitter-card.jpg'))">
    <meta name="twitter:image:alt" content="Seova SEO Virtual Assistant">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- JSON-LD Structured Data -->
    @yield('json-ld', '{}')

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ request()->is('/') ? url('/') : url()->current() }}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/site.webmanifest">

    @yield('meta')

    <!-- CSS -->
    @vite('resources/css/app.css')

    @stack('styles')

    <!-- Consent Mode & Analytics -->
    <script>
        // Define dataLayer and helper
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}

        // Check stored consent
        var storedConsent = localStorage.getItem('cookie_consent');
        var consentState = storedConsent === 'granted' ? 'granted' : 'denied';

        // Set Default Consent Mode (GA4)
        gtag('consent', 'default', {
            'ad_storage': consentState,
            'ad_user_data': consentState,
            'ad_personalization': consentState,
            'analytics_storage': consentState
        });
    </script>

    <!-- Google tag (gtag.js) -->
    @if(env('VITE_GOOGLE_ANALYTICS_ID'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('VITE_GOOGLE_ANALYTICS_ID') }}"></script>
    <script>
      gtag('js', new Date());
      gtag('config', '{{ env('VITE_GOOGLE_ANALYTICS_ID') }}');
    </script>
    @endif

    <!-- Meta Pixel Code -->
    @if(config('services.meta.pixel_id'))
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    
    fbq('init', '{{ config('services.meta.pixel_id') }}');
    
    // Check consent for Meta
    if (localStorage.getItem('cookie_consent') !== 'granted') {
        fbq('consent', 'revoke');
    } else {
        fbq('consent', 'grant');
    }
    
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id={{ config('services.meta.pixel_id') }}&ev=PageView&noscript=1"
    /></noscript>
    @endif
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <!-- Skip Links for Accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-md z-50">Skip to main content</a>

    @include('partials.navbar')

    {{-- Breadcrumbs (provided by middleware) --}}
    @isset($breadcrumbsHidden)
        @if(!$breadcrumbsHidden)
            <x-breadcrumbs :items="$breadcrumbs" />
        @endif
    @endisset

    @yield('hero')

    <!-- Main Content -->
    <main id="main-content" role="main">
        @yield('content')
    </main>

    @yield('additional-sections')

    {{-- Quote Modal Partial (hidden until triggered) --}}
    @include('partials.quote-modal')

    @include('partials.cookie-banner')

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6" role="contentinfo">

        @php($businessEmail = config('mail.from.address') ?? 'hello@seova.pro')

        <section class="bg-gray-900 text-gray-100 py-16 px-6" aria-labelledby="legal-heading">
            <div class="max-w-4xl mx-auto space-y-8 text-left">
                <h2 id="legal-heading" class="text-2xl font-bold text-center">Legal &amp; Contact Information</h2>
                <article id="privacy" class="space-y-2">
                    <h3 class="text-xl font-semibold">Privacy Policy</h3>
                    <p class="text-sm text-gray-300">Understand how we handle form submissions, analytics data, and free tool usage. <a href="{{ url('/privacy-policy') }}" class="text-seova-orange underline hover:text-seova-orange/80">Read the Privacy Policy</a>.</p>
                </article>
                <article class="space-y-2">
                    <h3 class="text-xl font-semibold">Terms of Service</h3>
                    <p class="text-sm text-gray-300">Review usage rules and liability details for our free and paid offerings. <a href="{{ url('/terms-of-service') }}" class="text-seova-orange underline hover:text-seova-orange/80">View the Terms of Service</a>.</p>
                </article>
                <article class="space-y-2">
                    <h3 class="text-xl font-semibold">Refund Policy</h3>
                    <p class="text-sm text-gray-300">Learn about our refund and cancellation policies for SEO services. <a href="{{ url('/refund-policy') }}" class="text-seova-orange underline hover:text-seova-orange/80">Read the Refund Policy</a>.</p>
                </article>
                {{-- Do not use this article <article class="space-y-2">
                    <h3 class="text-xl font-semibold">Direct Contact</h3>
                    <p class="text-sm text-gray-300">Prefer email? Reach us directly at <a href="mailto:{{ $businessEmail }}" class="text-seova-orange underline hover:text-seova-orange/80">{{ $businessEmail }}</a>.</p>
                </article> --}}
            </div>
        </section>
        <p>&copy; {{ date('Y') }} Seova.pro — Data-Driven SEO Virtual Assistant. All rights reserved.</p>
    </footer>

    <!-- JavaScript -->
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
