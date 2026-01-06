# Blog Post Creation System

This directory contains reusable prompts and templates for creating SEO-optimized blog posts for SeoVa.pro.

## Files

### 1. `blog-post-creation-prompt.md`
**Full comprehensive guide** with complete instructions for AI agents.

**Use when:** You want detailed control and the agent needs full context.

**Contains:**
- Business context and services
- 3-phase creation process (Discussion → Creation → Database)
- Keyword strategy guidelines
- HTML formatting requirements
- Quality checklist
- Example workflow

### 2. `blog-post-quick-start.md`
**Quick reference** that links to the full prompt.

**Use when:** You want to get started fast.

**How to use:**
1. Open `blog-post-quick-start.md`
2. Copy the entire content
3. Paste to your AI agent
4. Replace `[PASTE TOPIC HERE]` with your blog post topic
5. The agent will automatically read the full prompt file

### 3. `blog-post-template.json`
**JSON structure template** showing the exact database format.

**Use when:** You need to understand the data structure or manually create a post.

**Contains:**
- All required fields
- HTML structure examples
- FAQ format
- Notes on constraints

## Quick Usage

### Option A: Fastest Method
```bash
# 1. Copy quick-start prompt
cat prompts/blog-post-quick-start.md

# 2. Paste to AI agent and replace [PASTE TOPIC HERE] with:
"Link Building Strategies for Local Businesses"

# 3. Agent will handle the rest
```

### Option B: Full Control
```bash
# 1. Copy full prompt
cat prompts/blog-post-creation-prompt.md

# 2. Paste to AI agent

# 3. At the bottom, replace [PASTE TOPIC/TITLE HERE] with:
"How to Fix Broken Links and Improve SEO"

# 4. Agent follows 3-phase process
```

## Process Overview

### Phase 1: Discussion (AI proposes, you approve)
- Keywords & long-tail keywords analysis
- Content structure outline
- FAQ strategy
- Approach confirmation

### Phase 2: Content Creation (After your approval)
- 2,500+ word HTML content
- 8-10 SEO-optimized FAQs
- Case study with ROI numbers
- Strategic CTAs

### Phase 3: Database Insertion
- Saves to `/tmp/blog_post_data.json`
- Updates database via artisan tinker
- Verifies insertion

## Key Requirements

✅ **Format:** HTML tags only (no Markdown)
✅ **Length:** 2,500+ words
✅ **Audience:** Non-technical business owners
✅ **Tone:** Sales-oriented but educational
✅ **FAQs:** 8-10 questions, plain text answers
✅ **CTAs:** 2 placements (middle + end)
✅ **Price:** Mention $500-$4,500 range

❌ **Don't use:** Markdown syntax (`##`, `**`, `*`)
❌ **Don't use:** HTML in FAQ answers
❌ **Don't skip:** ROI case study with specific numbers

## Examples

### Good Blog Topics
- "Local SEO Checklist for Small Businesses"
- "How to Optimize Product Pages for E-Commerce SEO"
- "Content Marketing vs SEO: What's the Difference?"
- "Schema Markup Guide for Service Businesses"

### Avoid
- Topics too technical for business owners
- Topics unrelated to SEO services
- Topics without clear service tie-in

## Database Commands

### Update Existing Post
```bash
php artisan tinker --execute="
\$data = json_decode(file_get_contents('/tmp/blog_post_data.json'), true);
\$data['faqs'] = json_encode(\$data['faqs']);
\$post = \App\Models\Post::findOrFail(4);
\$post->update(\$data);
echo 'Updated: ' . \$post->title;
"
```

### Verify Post
```bash
sqlite3 database/database.sqlite "SELECT id, title, slug, published FROM posts;"
```

## Tips

1. **Let the agent discuss first** - Don't skip Phase 1, it ensures alignment
2. **Review keywords carefully** - They affect Google Ads costs
3. **Check HTML formatting** - Common mistake is using Markdown
4. **Verify FAQs are plain text** - No HTML in FAQ answers
5. **Include real numbers** - ROI, percentages, dollar amounts build trust

## Need Help?

- Check the full prompt: `prompts/blog-post-creation-prompt.md`
- Review existing posts: `sqlite3 database/database.sqlite "SELECT * FROM posts;"`
- View post template: `prompts/blog-post-template.json`
- See migration schema: `database/migrations/*_create_posts_table.php`

---

**Last Updated:** December 2025
**Maintained By:** SeoVa Team
