<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\StructuredDataService;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function __construct(private readonly StructuredDataService $structuredDataService)
    {
    }

    /**
     * Display all published posts
     */
    public function index(): View
    {
        $posts = Post::published()
            ->latest()
            ->paginate(10);

        // Get all posts for schema (not paginated)
        $allPosts = Post::published()->latest()->get();

        return view('posts.index', [
            'posts' => $posts,
            'structuredData' => $this->generateBlogIndexSchema($allPosts),
        ]);
    }

    /**
     * Generate schema for blog index page
     */
    private function generateBlogIndexSchema($posts): array
    {
        $baseUrl = url('/');
        $postsUrl = route('posts.index');
        $orgId = $baseUrl . '#organization';

        $postItems = $posts->map(function ($post) {
            return [
                '@type' => 'BlogPosting',
                'headline' => $post->title,
                'description' => $post->excerpt ?? substr(strip_tags($post->content), 0, 160),
                'url' => route('posts.show', $post->slug),
                'datePublished' => $post->published_at->toIso8601String(),
                'dateModified' => $post->updated_at->toIso8601String(),
                'image' => $post->featured_image ? [
                    '@type' => 'ImageObject',
                    'url' => $post->featured_image,
                ] : null,
                'author' => [
                    '@type' => 'Organization',
                    'name' => 'Seova'
                ]
            ];
        })->toArray();

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                // Organization
                [
                    '@type' => 'Organization',
                    '@id' => $orgId,
                    'name' => 'Seova',
                    'url' => $baseUrl,
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('img/seova-logo.png')
                    ]
                ],
                // Blog
                [
                    '@type' => 'Blog',
                    '@id' => $postsUrl . '#blog',
                    'name' => 'Seova SEO Blog',
                    'description' => 'Expert SEO insights, strategies, and tips for small businesses',
                    'url' => $postsUrl,
                    'publisher' => [
                        '@id' => $orgId
                    ]
                ],
                // Collection Page
                [
                    '@type' => 'CollectionPage',
                    '@id' => $postsUrl . '#webpage',
                    'name' => 'Blog - Seova SEO Articles & Resources',
                    'description' => 'Read our latest blog posts about SEO strategies, technical SEO tips, keyword research, and content optimization.',
                    'url' => $postsUrl,
                    'publisher' => [
                        '@id' => $orgId
                    ],
                    'mainEntity' => [
                        '@id' => $postsUrl . '#blog'
                    ],
                    'hasPart' => $postItems,
                ]
            ]
        ];
    }

    /**
     * Display a single post by slug
     */
    public function show(string $slug): View|Response
    {
        $post = Post::published()
            ->bySlug($slug)
            ->firstOrFail();

        return view('posts.show', [
            'post' => $post,
            'structuredData' => $this->structuredDataService->postStructuredData($post),
            'faqs' => $post->getFaqs(),
        ]);
    }
}
