<?php

namespace App\Services;

class StructuredDataService
{
    /**
     * Get the site-wide default structured data (organization + website)
     */
    public function homeStructuredData(): array
    {
        $homeUrl = url('/');
        $orgId = $homeUrl . '#organization';
        $websiteId = $homeUrl . '#website';
        $webpageId = $homeUrl . '#webpage';

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                // Organization (agency)
                [
                    '@type' => 'Organization',
                    '@id' => $orgId,
                    'name' => 'Seova',
                    'url' => $homeUrl,
                    'logo' => asset('img/seova-logo.png'),
                    'description' => 'Seova is an SEO Virtual Assistant agency helping small and medium businesses grow with smart, data-driven SEO.',
                    'areaServed' => 'Worldwide',
                    'contactPoint' => [
                        '@type' => 'ContactPoint',
                        'contactType' => 'customer support',
                        'url' => url('/') . '#contact',
                    ],
                ],

                // WebSite entity
                [
                    '@type' => 'WebSite',
                    '@id' => $websiteId,
                    'url' => $homeUrl,
                    'name' => 'Seova',
                    'publisher' => [
                        '@id' => $orgId,
                    ],
                    'inLanguage' => 'en',
                ],

                // WebPage entity (Home)
                [
                    '@type' => 'WebPage',
                    '@id' => $webpageId,
                    'url' => $homeUrl,
                    'name' => 'Seova SEO Virtual Assistant for Small Business',
                    'isPartOf' => [ '@id' => $websiteId ],
                    'about' => [ '@id' => $orgId ],
                    'inLanguage' => 'en',
                    'primaryImageOfPage' => [
                        '@type' => 'ImageObject',
                        '@id' => asset('img/seova-og-image.jpg') . '#primaryimage',
                        'url' => asset('img/seova-og-image.jpg'),
                        'contentUrl' => asset('img/seova-og-image.jpg'),
                    ],
                    'mainEntity' => [
                        '@id' => $homeUrl . '#faq',
                    ],
                ],

                // FAQ Page
                [
                    '@type' => 'FAQPage',
                    '@id' => $homeUrl . '#faq',
                    'mainEntity' => [
                        [
                            '@type' => 'Question',
                            'name' => 'What makes Seova different?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'We combine technical SEO expertise with deep data analysis to deliver growth you can measure.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'Can I use Seova without technical skills?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Absolutely. Our tools are built for simplicity, and we guide you every step of the way.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'Are the SEO tools really free?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Yes — supported by ads, not subscriptions. Use them anytime, no login required.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'What happens when I request a quote?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'We\'ll review your site, send a personalized growth plan, and suggest services that fit your goals.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'How long does it take to see SEO results?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Most businesses see meaningful traffic improvements in 3-6 months with consistent SEO efforts. Quick wins like on-page optimization can show results in weeks, but long-term ranking growth requires patience and strategy. We focus on sustainable growth, not shortcuts.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'What\'s the difference between technical SEO and on-page SEO?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Technical SEO fixes the foundation (site speed, mobile optimization, structured data), while on-page SEO targets keywords and user experience. Both are essential — think of technical SEO as the engine and on-page as the steering. We handle both to maximize your growth.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'How much should I budget for SEO?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'SEO budgets vary based on your industry and competition. Most small businesses invest $500-3,000/month for professional services, but our free tools and guidance are available immediately. Request a quote to get a personalized recommendation for your business.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'Can small businesses really compete with larger competitors in SEO?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Absolutely. While larger companies have bigger budgets, small businesses often win by targeting specific niches, being faster to implement changes, and building stronger community connections. Smart strategy beats big spend every time — that\'s Seova\'s philosophy.'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Structured data for the Word Counter tool page
     */
    public function wordCounterStructuredData(): array
    {
        $toolUrl = route('tools.word-counter');
        $homeUrl = url('/');
        $websiteId = $homeUrl . '#website';
        $orgId = $homeUrl . '#organization';

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                // Organization
                [
                    '@type' => 'Organization',
                    '@id' => $orgId,
                    'name' => 'Seova',
                    'url' => $homeUrl,
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('img/seova-logo.png')
                    ]
                ],
                // Website
                [
                    '@type' => 'WebSite',
                    '@id' => $websiteId,
                    'url' => $homeUrl,
                    'name' => 'Seova',
                    'publisher' => ['@id' => $orgId]
                ],
                [
                    '@type' => 'WebPage',
                    '@id' => $toolUrl . '#webpage',
                    'url' => $toolUrl,
                    'name' => 'Word Counter & Text Analyzer | Seova Free SEO Tool',
                    'isPartOf' => ['@id' => $websiteId],
                    'about' => ['@id' => $toolUrl . '#software'],
                    'inLanguage' => 'en',
                    'breadcrumb' => [
                        '@type' => 'BreadcrumbList',
                        'itemListElement' => [
                            [
                                '@type' => 'ListItem',
                                'position' => 1,
                                'name' => 'Home',
                                'item' => url('/')
                            ],
                            [
                                '@type' => 'ListItem',
                                'position' => 2,
                                'name' => 'Tools',
                                'item' => route('tools.index')
                            ],
                            [
                                '@type' => 'ListItem',
                                'position' => 3,
                                'name' => 'Word Counter',
                                'item' => $toolUrl
                            ]
                        ]
                    ]
                ],
                [
                    '@type' => 'SoftwareApplication',
                    '@id' => $toolUrl . '#software',
                    'name' => 'SEO Word Counter & Text Analyzer',
                    'description' => 'Free online tool to count words, characters, sentences, and analyze text structure for SEO content optimization.',
                    'applicationCategory' => 'BusinessApplication',
                    'operatingSystem' => 'Any',
                    'browserRequirements' => 'Requires JavaScript. Requires HTML5.',
                    'featureList' => ['Word Count', 'Character Count', 'Sentence Analysis', 'Paragraph Count', 'Reading Time Calculation'],
                    'offers' => [
                        '@type' => 'Offer',
                        'price' => '0',
                        'priceCurrency' => 'USD',
                        'availability' => 'https://schema.org/InStock'
                    ],
                    'provider' => ['@id' => $orgId]
                ],
                [
                    '@type' => 'FAQPage',
                    '@id' => $toolUrl . '#faq',
                    'mainEntity' => [
                        [
                            '@type' => 'Question',
                            'name' => 'What is the ideal blog post length for SEO?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'The ideal blog post length for SEO typically ranges between 1,500 and 2,500 words. This length allows you to cover topics comprehensively while maintaining reader engagement. Longer content often attracts more backlinks and social shares, though quality always trumps quantity.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'How long should a meta description be?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => "Meta descriptions should be between 150-160 characters to prevent truncation in search results. While they don't directly influence rankings, well-crafted meta descriptions can improve click-through rates."
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'What is the optimal paragraph length for readability?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'For optimal readability, paragraphs should contain 2-4 sentences. This structure improves content scanability and maintains reader engagement. Include subheadings every 300-350 words to further break up the content.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'How is reading time calculated?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Reading time is calculated based on an average reading speed of 200 words per minute for web content. This is a standard benchmark that accounts for varying comprehension levels and content complexity.'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Structured data for the Meta Tag Generator tool page
     */
    public function metaTagGeneratorStructuredData(): array
    {
        $toolUrl = route('tools.meta-tag-generator');
        $homeUrl = url('/');
        $websiteId = $homeUrl . '#website';
        $orgId = $homeUrl . '#organization';

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                // Organization
                [
                    '@type' => 'Organization',
                    '@id' => $orgId,
                    'name' => 'Seova',
                    'url' => $homeUrl,
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('img/seova-logo.png')
                    ]
                ],
                // Website
                [
                    '@type' => 'WebSite',
                    '@id' => $websiteId,
                    'url' => $homeUrl,
                    'name' => 'Seova',
                    'publisher' => ['@id' => $orgId]
                ],
                [
                    '@type' => 'WebPage',
                    '@id' => $toolUrl . '#webpage',
                    'url' => $toolUrl,
                    'name' => 'Meta Tag Generator | Seova Free SEO Tool',
                    'description' => 'Generate optimized meta tags for your web pages. Create SEO-friendly title tags, descriptions, and social media meta tags.',
                    'isPartOf' => ['@id' => $websiteId],
                    'about' => ['@id' => $toolUrl . '#software'],
                    'inLanguage' => 'en',
                    'mainEntity' => ['@id' => $toolUrl . '#faq'],
                    'breadcrumb' => [
                        '@type' => 'BreadcrumbList',
                        'itemListElement' => [
                            [
                                '@type' => 'ListItem',
                                'position' => 1,
                                'name' => 'Home',
                                'item' => url('/')
                            ],
                            [
                                '@type' => 'ListItem',
                                'position' => 2,
                                'name' => 'Tools',
                                'item' => route('tools.index')
                            ],
                            [
                                '@type' => 'ListItem',
                                'position' => 3,
                                'name' => 'Meta Tag Generator',
                                'item' => $toolUrl
                            ]
                        ]
                    ]
                ],
                [
                    '@type' => 'SoftwareApplication',
                    '@id' => $toolUrl . '#software',
                    'name' => 'SEO Meta Tag Generator',
                    'description' => 'Free online tool to generate and preview meta tags for better SEO and social media sharing.',
                    'applicationCategory' => 'BusinessApplication',
                    'operatingSystem' => 'Any',
                    'browserRequirements' => 'Requires JavaScript. Requires HTML5.',
                    'featureList' => ['Title Tag Generation', 'Meta Description', 'Open Graph Tags', 'Twitter Cards', 'Canonical URL', 'Robots Meta'],
                    'offers' => [
                        '@type' => 'Offer',
                        'price' => '0',
                        'priceCurrency' => 'USD',
                        'availability' => 'https://schema.org/InStock'
                    ],
                    'provider' => ['@id' => $orgId]
                ],
                [
                    '@type' => 'FAQPage',
                    '@id' => $toolUrl . '#faq',
                    'mainEntity' => [
                        [
                            '@type' => 'Question',
                            'name' => 'What meta tags are most important for SEO?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'The most important meta tags for SEO are the title tag and meta description. The title tag should be 50-60 characters and include your main keyword, while the meta description should be 150-160 characters and provide a compelling summary of your page content.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'What are Open Graph meta tags used for?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Open Graph (OG) meta tags are used to control how your content appears when shared on social media platforms like Facebook and LinkedIn. They allow you to specify the title, description, and image that should be displayed when your page is shared.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'Why are Twitter Card meta tags important?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Twitter Card meta tags help your content stand out when shared on Twitter by controlling how your tweets appear with rich media. They allow you to specify a custom title, description, and image specifically for Twitter sharing.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'What should I put in the robots meta tag?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'The robots meta tag controls how search engines crawl and index your page. Common values include "index,follow" (default), "noindex,follow" (prevent indexing but follow links), and "noindex,nofollow" (prevent indexing and following links).'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Structured data for the SERP Preview tool page
     */
    public function serpPreviewStructuredData(): array
    {
        $toolUrl = route('tools.serp');
        $homeUrl = url('/');
        $websiteId = $homeUrl . '#website';
        $orgId = $homeUrl . '#organization';

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                // Organization
                [
                    '@type' => 'Organization',
                    '@id' => $orgId,
                    'name' => 'Seova',
                    'url' => $homeUrl,
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('img/seova-logo.png')
                    ]
                ],
                // Website
                [
                    '@type' => 'WebSite',
                    '@id' => $websiteId,
                    'url' => $homeUrl,
                    'name' => 'Seova',
                    'publisher' => ['@id' => $orgId]
                ],
                [
                    '@type' => 'WebPage',
                    '@id' => $toolUrl . '#webpage',
                    'url' => $toolUrl,
                    'name' => 'SERP Preview Tool | Seova Free SEO Tool',
                    'description' => 'Craft SEO‑friendly titles & meta descriptions and see how they may appear in Google or Bing. Fetch an existing page or write manually.',
                    'isPartOf' => ['@id' => $websiteId],
                    'about' => ['@id' => $toolUrl . '#software'],
                    'inLanguage' => 'en',
                    'breadcrumb' => [
                        '@type' => 'BreadcrumbList',
                        'itemListElement' => [
                            [
                                '@type' => 'ListItem',
                                'position' => 1,
                                'name' => 'Home',
                                'item' => url('/')
                            ],
                            [
                                '@type' => 'ListItem',
                                'position' => 2,
                                'name' => 'Tools',
                                'item' => route('tools.index')
                            ],
                            [
                                '@type' => 'ListItem',
                                'position' => 3,
                                'name' => 'SERP Preview',
                                'item' => $toolUrl
                            ]
                        ]
                    ]
                ],
                [
                    '@type' => 'SoftwareApplication',
                    '@id' => $toolUrl . '#software',
                    'name' => 'SERP Preview Tool',
                    'description' => 'Free online tool to simulate how your page title and meta description might appear in search results.',
                    'applicationCategory' => 'BusinessApplication',
                    'operatingSystem' => 'Any',
                    'browserRequirements' => 'Requires JavaScript. Requires HTML5.',
                    'featureList' => ['Google SERP Preview', 'Bing SERP Preview', 'Mobile Preview', 'Desktop Preview', 'Meta Tag Fetching', 'Keyword Highlighting'],
                    'offers' => [
                        '@type' => 'Offer',
                        'price' => '0',
                        'priceCurrency' => 'USD',
                        'availability' => 'https://schema.org/InStock'
                    ],
                    'provider' => ['@id' => $orgId]
                ]
            ]
        ];
    }

    /**
     * Structured data for the JSON Schema Validator tool page
     */
    public function jsonSchemaValidatorStructuredData(): array
    {
        $toolUrl = route('tools.json-schema-validator');
        $homeUrl = url('/');
        $websiteId = $homeUrl . '#website';
        $orgId = $homeUrl . '#organization';

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                // Organization
                [
                    '@type' => 'Organization',
                    '@id' => $orgId,
                    'name' => 'Seova',
                    'url' => $homeUrl,
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('img/seova-logo.png')
                    ]
                ],
                // Website
                [
                    '@type' => 'WebSite',
                    '@id' => $websiteId,
                    'url' => $homeUrl,
                    'name' => 'Seova',
                    'publisher' => ['@id' => $orgId]
                ],
                [
                    '@type' => 'WebPage',
                    '@id' => $toolUrl . '#webpage',
                    'url' => $toolUrl,
                    'name' => 'JSON Schema Validator | Seova Free SEO Tool',
                    'description' => 'Validate your JSON-LD schemas with our free online tool. Ensure your structured data is correct and error-free for better SEO.',
                    'isPartOf' => ['@id' => $websiteId],
                    'about' => ['@id' => $toolUrl . '#software'],
                    'inLanguage' => 'en',
                    'breadcrumb' => [
                        '@type' => 'BreadcrumbList',
                        'itemListElement' => [
                            [
                                '@type' => 'ListItem',
                                'position' => 1,
                                'name' => 'Home',
                                'item' => url('/')
                            ],
                            [
                                '@type' => 'ListItem',
                                'position' => 2,
                                'name' => 'Tools',
                                'item' => route('tools.index')
                            ],
                            [
                                '@type' => 'ListItem',
                                'position' => 3,
                                'name' => 'JSON Schema Validator',
                                'item' => $toolUrl
                            ]
                        ]
                    ]
                ],
                [
                    '@type' => 'SoftwareApplication',
                    '@id' => $toolUrl . '#software',
                    'name' => 'JSON Schema Validator',
                    'description' => 'Free online tool to validate JSON data against JSON Schema for structured data verification and API testing.',
                    'applicationCategory' => 'DeveloperApplication',
                    'operatingSystem' => 'Any',
                    'browserRequirements' => 'Requires JavaScript. Requires HTML5.',
                    'featureList' => ['JSON Schema Validation', 'JSON-LD Testing', 'Schema Format Validation', 'Error Detection', 'Real-time Validation'],
                    'offers' => [
                        '@type' => 'Offer',
                        'price' => '0',
                        'priceCurrency' => 'USD',
                        'availability' => 'https://schema.org/InStock'
                    ],
                    'provider' => ['@id' => $orgId]
                ]
            ]
        ];
    }

    /**
     * Structured data for the Tools Index page
     */
    public function toolsIndexStructuredData(): array
    {
        $toolsUrl = route('tools.index');
        $homeUrl = url('/');
        $websiteId = $homeUrl . '#website';
        $orgId = $homeUrl . '#organization';

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                // Organization
                [
                    '@type' => 'Organization',
                    '@id' => $orgId,
                    'name' => 'Seova',
                    'url' => $homeUrl,
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('img/seova-logo.png')
                    ]
                ],
                // Website
                [
                    '@type' => 'WebSite',
                    '@id' => $websiteId,
                    'url' => $homeUrl,
                    'name' => 'Seova',
                    'publisher' => ['@id' => $orgId]
                ],
                [
                    '@type' => 'WebPage',
                    '@id' => $toolsUrl . '#webpage',
                    'url' => $toolsUrl,
                    'name' => 'Free SEO Tools | Seova',
                    'description' => 'A collection of free SEO tools to help you with your SEO tasks.',
                    'isPartOf' => ['@id' => $websiteId],
                    'inLanguage' => 'en',
                    'mainEntity' => [
                        '@type' => 'CollectionPage',
                        'name' => 'Free SEO Tools',
                        'hasPart' => [
                            [
                                '@type' => 'WebPage',
                                'name' => 'SERP Preview',
                                'url' => route('tools.serp'),
                            ],
                            [
                                '@type' => 'WebPage',
                                'name' => 'Word Counter',
                                'url' => route('tools.word-counter'),
                            ],
                            [
                                '@type' => 'WebPage',
                                'name' => 'Meta Tag Generator',
                                'url' => route('tools.meta-tag-generator'),
                            ],
                            [
                                '@type' => 'WebPage',
                                'name' => 'JSON Schema Validator',
                                'url' => route('tools.json-schema-validator'),
                            ],
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Structured data for a single blog post (BlogPosting with FAQ schema)
     */
    public function postStructuredData($post): array
    {
        $baseUrl = url('/');
        $postUrl = route('posts.show', $post->slug);
        $orgId = $baseUrl . '#organization';
        $postId = $postUrl . '#article';
        $faqId = $postUrl . '#faq';

        $graph = [
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
            // Blog Posting
            [
                '@type' => 'BlogPosting',
                '@id' => $postId,
                'headline' => $post->seo_title ?? $post->title,
                'description' => $post->seo_description ?? $post->excerpt ?? substr(strip_tags($post->content), 0, 160),
                'datePublished' => $post->published_at->toIso8601String(),
                'dateModified' => $post->updated_at->toIso8601String(),
                'author' => [
                    '@type' => 'Organization',
                    '@id' => $orgId,
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    '@id' => $orgId,
                ],
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id' => $postUrl,
                ],
                'url' => $postUrl,
                'wordCount' => str_word_count($post->content),
                'keywords' => $post->seo_keywords ?? '',
            ]
        ];

        // Add featured image if available
        if ($post->featured_image) {
            $graph[1]['image'] = [
                '@type' => 'ImageObject',
                'url' => $post->featured_image,
                'width' => 1200,
                'height' => 630
            ];
        }

        // Extract and add FAQs if available
        $faqs = $post->getFaqs();
        if (!empty($faqs)) {
            $faqMainEntity = [];
            foreach ($faqs as $faq) {
                $faqMainEntity[] = [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['answer']
                    ]
                ];
            }

            $graph[] = [
                '@type' => 'FAQPage',
                '@id' => $faqId,
                'mainEntity' => $faqMainEntity
            ];

            // Link blog post to FAQ
            $graph[1]['mainEntity'] = ['@id' => $faqId];
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph
        ];
    }
}
