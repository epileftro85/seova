<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Technical SEO Audit: A Complete Guide for Small Businesses',
            'slug' => 'technical-seo-audit-guide',
            'excerpt' => 'Learn how to perform a comprehensive technical SEO audit to identify and fix issues that are preventing your website from ranking.',
            'content' => "Technical SEO forms the foundation of your digital presence. Without it, even the best content won't rank. In this guide, we'll walk you through everything you need to know about conducting a technical SEO audit.

## What is Technical SEO?

Technical SEO refers to optimizing your website's infrastructure to help search engines crawl and index your content more effectively. This includes site speed, mobile optimization, structured data, and more.

## Key Areas to Audit

1. **Site Speed**: Use Google PageSpeed Insights to check your loading times
2. **Mobile Optimization**: Ensure your site is fully responsive
3. **SSL Certificate**: Your site must use HTTPS
4. **Sitemap and Robots.txt**: Help search engines understand your site structure
5. **Structured Data**: Implement schema markup for better rich snippets

## How to Fix Common Issues

Start by identifying the most impactful issues first. Usually, fixing site speed and mobile optimization will give you the biggest boost.",
            'faqs' => [
                [
                    'question' => 'How long does a technical SEO audit take?',
                    'answer' => 'A technical SEO audit can take anywhere from a few hours to several days depending on your website\'s size and complexity. A small site might take 4-8 hours while enterprise sites could require 1-2 weeks.'
                ],
                [
                    'question' => 'What tools do I need for a technical SEO audit?',
                    'answer' => 'Essential tools include Google Search Console, Google PageSpeed Insights, Google Mobile-Friendly Test, Screaming Frog (for crawling), and Schema.org validator. Most of these are free or have free versions.'
                ],
                [
                    'question' => 'How often should I perform a technical SEO audit?',
                    'answer' => 'We recommend performing a comprehensive audit at least twice a year, and quarterly if you\'re making significant changes to your site. Monthly spot checks on critical areas like site speed are also beneficial.'
                ],
                [
                    'question' => 'Can I fix all technical SEO issues myself?',
                    'answer' => 'Some issues like mobile optimization and basic structured data can be fixed by most website owners. However, server-level issues, site architecture changes, and complex redirects may require developer assistance.'
                ]
            ],
            'seo_title' => 'Technical SEO Audit Guide | Seova',
            'seo_description' => 'Complete guide to performing a technical SEO audit for small businesses. Fix site speed, mobile, structured data, and more.',
            'seo_keywords' => 'technical SEO, SEO audit, site speed, mobile optimization, structured data',
            'published' => true,
            'published_at' => now()->subDays(15),
        ]);

        Post::create([
            'title' => 'On-Page SEO Best Practices: Optimize Your Content to Rank',
            'slug' => 'on-page-seo-best-practices',
            'excerpt' => 'Master on-page SEO with our comprehensive guide on title tags, meta descriptions, heading structure, and internal linking strategies.',
            'content' => "On-page SEO is about optimizing individual pages on your website to rank higher and earn more relevant traffic. Here's everything you need to know.

## Title Tags and Meta Descriptions

Your title tag should be 50-60 characters and include your target keyword. Meta descriptions should be 150-160 characters and provide a compelling reason to click.

## Heading Structure

Use H1 tags for your main topic, H2 for sections, and H3 for subsections. This helps both users and search engines understand your content hierarchy.

## Keyword Optimization

Include your target keyword naturally in:
- Title tag (1-2 times)
- First paragraph (within 100 words)
- Headings (1-2 times)
- Body content (naturally distributed)

## Internal Linking

Link to other relevant pages on your site. This helps distribute page authority and keeps users engaged longer.

## Word Count

Aim for at least 1,500-2,500 words for comprehensive coverage of topics.",
            'faqs' => [
                [
                    'question' => 'Should I optimize for multiple keywords on one page?',
                    'answer' => 'No, focus on one primary keyword and 2-3 related secondary keywords per page. Trying to rank for too many keywords dilutes your optimization efforts and confuses search engines about your main topic.'
                ],
                [
                    'question' => 'Does meta description affect rankings?',
                    'answer' => 'Meta descriptions don\'t directly affect rankings, but they impact click-through rates from search results. A compelling description can increase traffic from the same ranking position.'
                ],
                [
                    'question' => 'How many internal links should I include?',
                    'answer' => 'There\'s no magic number, but typically 3-5 internal links per 1,000 words is a good guideline. Each link should be contextual and add value to the reader.'
                ]
            ],
            'seo_title' => 'On-Page SEO Best Practices | Complete Guide',
            'seo_description' => 'Learn on-page SEO best practices for title tags, meta descriptions, headings, keywords, and internal linking.',
            'seo_keywords' => 'on-page SEO, title tags, meta descriptions, keyword optimization, internal linking',
            'published' => true,
            'published_at' => now()->subDays(10),
        ]);

        Post::create([
            'title' => 'Keyword Research for Small Business: A Practical Strategy',
            'slug' => 'keyword-research-small-business',
            'excerpt' => 'Discover how to find profitable keywords that your target audience is actually searching for without spending thousands on tools.',
            'content' => "Keyword research is the foundation of any successful SEO strategy. Find the right keywords and you'll attract qualified traffic to your site.

## Why Keyword Research Matters

Not all traffic is equal. A visitor searching for 'how to fix a leaky faucet' isn't relevant to a plumber unless they're in your service area. Keyword research helps you target the right people.

## Types of Keywords to Target

1. **Short-tail keywords**: Broad searches like 'plumbing services'
2. **Long-tail keywords**: Specific searches like 'emergency plumbing services in Austin'
3. **Question keywords**: 'How to fix a leaky faucet'
4. **Commercial intent**: 'Buy new kitchen faucet online'

## Free Tools for Keyword Research

- Google Search Console: See what keywords bring traffic
- Google Trends: Understand search trends over time
- Ubersuggest: Get keyword ideas and competition data
- AnswerThePublic: Find questions people are asking

## How to Evaluate Keywords

Look for keywords with:
- Decent search volume (100+ searches/month)
- Lower competition (especially for new sites)
- Clear commercial intent (if selling products/services)
- Local relevance (if you're location-based)",
            'faqs' => [
                [
                    'question' => 'How much search volume do I need to target a keyword?',
                    'answer' => 'For new sites, we recommend targeting keywords with at least 100-300 monthly searches. Established sites can go after more competitive keywords with higher volume. It\'s better to own 1,000 searches a month than compete for 100,000.'
                ],
                [
                    'question' => 'Should I use keyword research tools?',
                    'answer' => 'Free tools are excellent to start. Google Search Console and Google Trends are invaluable. Paid tools like Semrush, Ahrefs, or Ubersuggest provide competitive data, but aren\'t necessary for small businesses starting out.'
                ],
                [
                    'question' => 'How many keywords should I target?',
                    'answer' => 'Start with 10-20 primary keywords and gradually expand. Each main keyword can have 5-10 related variations. Focus on dominating your niche before expanding to new areas.'
                ]
            ],
            'seo_title' => 'Keyword Research Guide for Small Business SEO',
            'seo_description' => 'Practical keyword research strategy for small businesses. Find profitable keywords without expensive tools.',
            'seo_keywords' => 'keyword research, target keywords, long-tail keywords, keyword analysis, search volume',
            'published' => true,
            'published_at' => now()->subDays(5),
        ]);

        Post::create([
            'title' => 'Why Your Website Speed Matters for SEO and User Experience',
            'slug' => 'website-speed-seo-performance',
            'excerpt' => 'Slow websites lose visitors and rank lower on Google. Learn how to improve your site speed and boost both SEO and conversions.',
            'content' => "Page speed is both a ranking factor and a user experience issue. Google has confirmed that Core Web Vitals are ranking factors, and slow sites convert worse.

## How Speed Affects SEO

Google's algorithm considers page experience, which includes:
- Largest Contentful Paint (LCP): How fast the main content loads
- First Input Delay (FID): How responsive your site is
- Cumulative Layout Shift (CLS): How stable your page is during loading

## Speed Impact on Conversions

Studies show that:
- 40% of visitors leave if a page takes more than 3 seconds to load
- A 1-second delay reduces conversions by 7%
- 53% of mobile users abandon sites that take longer than 3 seconds

## How to Improve Site Speed

1. **Enable compression**: Reduce file sizes
2. **Optimize images**: Use modern formats like WebP
3. **Minimize CSS/JS**: Remove unused code
4. **Use a CDN**: Serve content from locations near visitors
5. **Cache aggressively**: Store frequently accessed data
6. **Upgrade hosting**: Better servers = faster sites",
            'faqs' => [
                [
                    'question' => 'What is a good page speed score?',
                    'answer' => 'Google PageSpeed Insights rates sites as: 90+ is excellent, 50-89 is needs improvement, below 50 is poor. Aim for at least 75+ on both mobile and desktop. However, real-world performance metrics matter more than the score itself.'
                ],
                [
                    'question' => 'How does page speed affect rankings?',
                    'answer' => 'Page speed is a confirmed ranking factor for both desktop and mobile. Google uses Core Web Vitals (LCP, FID, CLS) as ranking signals. Sites with faster speeds often rank higher for the same keywords, especially on mobile.'
                ],
                [
                    'question' => 'Will caching slow down my site?',
                    'answer' => 'No, proper caching significantly speeds up your site. Browser caching stores static files locally on visitors\' devices, reducing load times on repeat visits. Server-side caching reduces database queries. Both improve performance dramatically.'
                ],
                [
                    'question' => 'Should I use a CDN?',
                    'answer' => 'CDNs are beneficial, especially if your visitors are geographically spread out. They\'re worth implementing once you\'ve optimized other basics. Most CDNs offer reasonable pricing and setup is straightforward.'
                ]
            ],
            'seo_title' => 'Website Speed SEO Guide | Performance Tips',
            'seo_description' => 'Learn why site speed matters for SEO and conversions. Practical tips to improve Core Web Vitals and page performance.',
            'seo_keywords' => 'website speed, page speed, core web vitals, site performance, LCP, FID, CLS',
            'published' => true,
            'published_at' => now()->subDays(2),
        ]);
    }
}
