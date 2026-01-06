# Blog Post Creation Prompt Template

## Instructions for AI Agent

You are helping create SEO-optimized blog posts for SeoVa.pro, a professional SEO services business. Follow this structured process to create high-quality, conversion-focused content.

---

## BLOG POST TOPIC
**[ASK FOR THE POST]**

---

## BUSINESS CONTEXT

**Company:** SeoVa (https://www.seova.pro)
**Services:** Website optimization, SEO audits, ongoing monitoring
**Price Range:** $500 - $4,500 (depending on complexity)
**Platforms:** WordPress, custom sites (experienced with other platforms)
**Target Audience:** Non-technical business owners
**Tone:** Sales-oriented but educational (build trust before asking)

---

## TASK PHASES

### PHASE 1: DISCUSSION & PLANNING (DO NOT WRITE CODE YET)

Before writing any content, discuss and present the following for user approval:

#### 1. Keywords & Long Tail Keywords
- **Primary Keywords** (Medium Competition, CPC $2-7)
  - Focus on commercial intent keywords
  - Avoid expensive keywords like "SEO services" ($20-50 CPC)

- **Long Tail Keywords** (Lower Cost, Higher Intent, CPC $1-5)
  - Question-based queries
  - Problem-aware buyer keywords
  - Platform-specific if applicable
  - Action-oriented phrases

- **Local Modifiers** (if applicable)

**Avoid:** Overly expensive keywords (>$10 CPC unless justified)

#### 2. Main Content Structure
Propose a detailed outline including:
- Hook/opening paragraph (emotional/business impact)
- Main sections (8-12 sections recommended)
- Real examples or case studies
- Tools/resources section (if applicable)
- Mobile-specific content (if applicable)
- CTA placement (middle and end)
- When to hire a professional section (service pitch)
- Conclusion with strong CTA

**Target Length:** 2,500+ words

#### 3. FAQ Strategy
Propose 8-10 FAQs that:
- Address common objections
- Target search queries
- Include pricing transparency FAQ
- Cover technical and non-technical questions
- Use question format that matches voice search

#### 4. Content Approach
Confirm:
- Technical depth (non-technical for business owners)
- Sales vs. educational balance (sales-oriented)
- Tone and voice
- CTA strategy (leverage existing header button and quote modal)

---

### PHASE 2: CONTENT CREATION

Once the user approves Phase 1, create the complete blog post with:

#### Content Requirements:
- **Length:** 2,500+ words
- **Format:** HTML (NOT Markdown)
- **Audience:** Non-technical business owners
- **Tone:** Sales-oriented but trustworthy

#### HTML Structure Requirements:
```html
<!-- Use these HTML tags ONLY -->
<h2>Main Section Heading</h2>
<h3>Subsection Heading</h3>
<h4>Specific Point Heading</h4>
<p>Paragraph text with <strong>bold</strong> and <em>italic</em> as needed.</p>
<ul>
  <li>Unordered list item</li>
</ul>
<ol>
  <li>Ordered list item</li>
</ol>
<a href="https://example.com" target="_blank" rel="noopener">External Link</a>
<hr>
```

**CRITICAL:**
- Use HTML tags, NOT Markdown syntax
- No `###` or `**text**` - use `<h3>` and `<strong>text</strong>`
- FAQs should be plain text (no HTML in answers)
- All external links need `target="_blank" rel="noopener"`

#### Content Elements to Include:

1. **Introduction**
   - Strong hook with business/revenue impact
   - Statistics showing cost of problem
   - Promise of actionable solution

2. **Main Body Sections**
   - Data-driven arguments (studies, stats, percentages)
   - Real-world examples
   - Business impact focus (ROI, conversions, revenue)
   - Concrete numbers and case studies
   - Strategic CTAs (middle and end)

3. **Service Positioning**
   - "When to Hire a Professional" section
   - Price range transparency ($500-$4,500)
   - Service value proposition
   - ROI justification

4. **Case Study/Example**
   - Before/after scenario
   - Specific metrics and results
   - ROI calculation
   - Realistic timeline

5. **Conclusion**
   - Summarize business impact
   - Urgency without pressure
   - Strong CTA for audit/consultation

6. **FAQs (8-10 questions)**
   - Plain text answers (no HTML)
   - Address objections
   - Include pricing FAQ
   - Technical and non-technical mix

#### SEO Metadata:
- **SEO Title:** 50-60 characters, keyword-focused
- **SEO Description:** 150-160 characters, compelling with CTA
- **SEO Keywords:** Comma-separated, 8-12 keywords
- **Excerpt:** 300-500 characters, engaging summary

---

### PHASE 3: DATABASE INSERTION

After user approves the content, add it to the database:

#### Method 1: Update Existing Post (Recommended for Production)
```bash
php artisan tinker --execute="
\$data = json_decode(file_get_contents('/tmp/blog_post_data.json'), true);
\$data['faqs'] = json_encode(\$data['faqs']);
\$post = \App\Models\Post::findOrFail([POST_ID]);
\$post->update(\$data);
echo 'Post updated: ' . \$post->title;
"
```

#### Method 2: Create New Post (If BLOG_POSTS_EDITABLE=true)
Use the endpoint: `POST /posts` via PostWriteController

#### Required Database Fields:
```json
{
  "title": "Full Post Title",
  "slug": "url-friendly-slug",
  "excerpt": "Brief summary (300-500 chars)",
  "content": "<p>Full HTML content here...</p>",
  "featured_image": "",
  "seo_title": "SEO Title (50-60 chars)",
  "seo_description": "SEO Description (150-160 chars)",
  "seo_keywords": "keyword1, keyword2, keyword3",
  "published": true,
  "faqs": [
    {
      "question": "Question text?",
      "answer": "Plain text answer without HTML"
    }
  ]
}
```

---

## QUALITY CHECKLIST

Before finalizing, verify:

- [ ] Content is 2,500+ words
- [ ] All content uses HTML tags (no Markdown)
- [ ] FAQs are plain text (no HTML in answers)
- [ ] External links have `target="_blank" rel="noopener"`
- [ ] 2 CTAs placed (middle section + conclusion)
- [ ] Price range mentioned ($500-$4,500)
- [ ] Case study includes specific ROI numbers
- [ ] 8-10 FAQs included
- [ ] SEO title is 50-60 characters
- [ ] SEO description is 150-160 characters
- [ ] Keywords are commercial intent focused
- [ ] Tone is sales-oriented but educational
- [ ] Content targets non-technical business owners
- [ ] Mobile considerations included (if applicable)
- [ ] Statistics and data cited throughout
- [ ] Strong hook in introduction
- [ ] "When to Hire Professional" section included

---

## EXAMPLE WORKFLOW

1. **User provides topic:** "Local SEO for Small Businesses"

2. **Agent responds with Phase 1:**
   - Keywords analysis (primary + long tail)
   - Detailed content outline
   - FAQ strategy
   - Confirms approach

3. **User approves or requests changes**

4. **Agent creates full HTML content:**
   - Saves to `/tmp/blog_post_data.json`
   - Shows preview of structure

5. **User approves**

6. **Agent updates database:**
   - Uses artisan tinker
   - Verifies insertion
   - Confirms live URL

---

## NOTES

- **Never** use Markdown syntax (`###`, `**`, `*`, etc.)
- **Always** use HTML tags (`<h2>`, `<strong>`, `<em>`, etc.)
- FAQs render as plain text, so no HTML in FAQ answers
- The site uses Tailwind Typography (`prose` class) for styling
- Content is rendered with `{!! $post->content !!}` (raw HTML)
- Focus on business ROI, not just technical explanations
- Include real numbers: percentages, dollar amounts, timeframes
- Balance education with sales (build authority, then offer service)

---

## FILES TO CREATE

1. `/tmp/blog_post_data.json` - Full post data for database insertion
2. Verification queries to confirm proper insertion

---

## CURRENT ENVIRONMENT

- **Project:** Laravel application (SeoVa.pro)
- **Database:** SQLite (`database/database.sqlite`)
- **Posts Table:** `posts` (see migrations for schema)
- **Production Mode:** `BLOG_POSTS_EDITABLE=false`
- **Insertion Method:** Use `php artisan tinker` for production safety

---

## START HERE

**What is the blog post topic?** [Paste topic/title and the agent will begin Phase 1]
