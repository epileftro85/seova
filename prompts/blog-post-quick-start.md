# Quick Start: Blog Post Creation

## Copy and paste this to any AI agent:

---

I need you to create an SEO-optimized blog post following this exact process. Read the full instructions at `/home/andru/Projects/seova/prompts/blog-post-creation-prompt.md`

**Blog Topic:** [PASTE TOPIC HERE]

**Quick Context:**
- Business: SeoVa.pro (SEO services)
- Target: Non-technical business owners
- Tone: Sales-oriented but educational
- Length: 2,500+ words
- Format: HTML (NOT Markdown)
- Price Range: $500-$4,500
- CTAs: Middle + End

**Process:**
1. First, discuss keywords, content structure, and FAQs (don't write code yet)
2. After I approve, create full HTML content with 8-10 FAQs
3. Save to `/tmp/blog_post_data.json`
4. Update database using `php artisan tinker`

**Critical:** Use HTML tags (`<h2>`, `<p>`, `<strong>`), NOT Markdown (`##`, `**`)

Start with Phase 1: Keyword and content structure discussion.

---
