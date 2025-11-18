<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate XML sitemap for SEO
     */
    public function index(): Response
    {
        $sitemap = $this->generateSitemap();

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Generate the sitemap XML content
     */
    private function generateSitemap(): string
    {
        $baseUrl = url('/');
        $today = now()->format('Y-m-d');

        // Define all pages with their properties
        $pages = [
            // Main pages
            [
                'url' => $baseUrl,
                'lastmod' => $today,
                'changefreq' => 'weekly',
                'priority' => '1.0',
            ],
            [
                'url' => route('privacy-policy'),
                'lastmod' => $today,
                'changefreq' => 'monthly',
                'priority' => '0.5',
            ],
            [
                'url' => route('terms-of-service'),
                'lastmod' => $today,
                'changefreq' => 'monthly',
                'priority' => '0.5',
            ],

            // Blog posts index
            [
                'url' => route('posts.index'),
                'lastmod' => $today,
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],

            // Tools pages
            [
                'url' => route('tools.index'),
                'lastmod' => $today,
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ],
            [
                'url' => route('tools.serp'),
                'lastmod' => $today,
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'url' => route('tools.word-counter'),
                'lastmod' => $today,
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'url' => route('tools.meta-tag-generator'),
                'lastmod' => $today,
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'url' => route('tools.json-schema-validator'),
                'lastmod' => $today,
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
        ];

        // Add all published posts dynamically
        $posts = Post::published()->get();
        foreach ($posts as $post) {
            $pages[] = [
                'url' => route('posts.show', $post->slug),
                'lastmod' => $post->updated_at->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        }

        // Build XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . PHP_EOL;
        $xml .= '         xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"' . PHP_EOL;
        $xml .= '         xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0">' . PHP_EOL;

        foreach ($pages as $page) {
            $xml .= $this->buildUrlEntry($page);
        }

        $xml .= '</urlset>';

        return $xml;
    }

    /**
     * Build individual URL entry for sitemap
     */
    private function buildUrlEntry(array $page): string
    {
        $url = htmlspecialchars($page['url'], ENT_XML1, 'UTF-8');
        $lastmod = $page['lastmod'] ?? now()->format('Y-m-d');
        $changefreq = $page['changefreq'] ?? 'weekly';
        $priority = $page['priority'] ?? '0.7';

        return <<<XML
    <url>
        <loc>$url</loc>
        <lastmod>$lastmod</lastmod>
        <changefreq>$changefreq</changefreq>
        <priority>$priority</priority>
    </url>

XML;
    }
}
