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
        $websiteId = url('/') . '#website';
        $orgId = url('/') . '#organization';

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebPage',
                    '@id' => $toolUrl . '#webpage',
                    'url' => $toolUrl,
                    'name' => 'Word Counter & Text Analyzer | Seova Free SEO Tool',
                    'description' => 'Free tool to count words, characters, sentences and calculate reading time. Perfect for content optimization and SEO writing.',
                    'isPartOf' => ['@id' => $websiteId],
                    'publisher' => ['@id' => $orgId],
                    'inLanguage' => 'en'
                ],
                [
                    '@type' => 'SoftwareApplication',
                    '@id' => $toolUrl . '#software',
                    'name' => 'SEO Word Counter & Text Analyzer',
                    'description' => 'Free online tool to count words, characters, sentences, and analyze text structure for SEO content optimization.',
                    'applicationCategory' => 'SEO Tool',
                    'operatingSystem' => 'Any',
                    'offers' => [
                        '@type' => 'Offer',
                        'price' => '0',
                        'priceCurrency' => 'USD'
                    ]
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
        $websiteId = url('/') . '#website';
        $orgId = url('/') . '#organization';

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebPage',
                    '@id' => $toolUrl . '#webpage',
                    'url' => $toolUrl,
                    'name' => 'Meta Tag Generator | Seova Free SEO Tool',
                    'description' => 'Generate optimized meta tags for your web pages. Create SEO-friendly title tags, descriptions, and social media meta tags.',
                    'isPartOf' => ['@id' => $websiteId],
                    'publisher' => ['@id' => $orgId],
                    'inLanguage' => 'en'
                ],
                [
                    '@type' => 'SoftwareApplication',
                    '@id' => $toolUrl . '#software',
                    'name' => 'SEO Meta Tag Generator',
                    'description' => 'Free online tool to generate and preview meta tags for better SEO and social media sharing.',
                    'applicationCategory' => 'SEO Tool',
                    'operatingSystem' => 'Any',
                    'offers' => [
                        '@type' => 'Offer',
                        'price' => '0',
                        'priceCurrency' => 'USD'
                    ]
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
}
