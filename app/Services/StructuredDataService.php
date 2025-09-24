<?php

namespace App\Services;

class StructuredDataService
{
    /**
     * Structured data for the Home page
     */
    public function homeStructuredData(): array
    {
        $homeUrl = url('/');
        $orgId = $homeUrl . '#organization';

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

                // Service offered by the agency
                [
                    '@type' => 'Service',
                    'name' => 'SEO Virtual Assistant Services',
                    'description' => 'Technical SEO audits, keyword strategy, ROI-focused analysis, and automated reporting tailored for SMBs.',
                    'provider' => [
                        '@type' => 'Organization',
                        '@id' => $orgId,
                    ],
                    'audience' => [
                        '@type' => 'BusinessAudience',
                        'name' => 'Small and Medium Businesses',
                        'audienceType' => 'SMB',
                    ],
                    'offers' => [
                        '@type' => 'Offer',
                        'url' => $homeUrl . '#contact',
                        'priceCurrency' => 'USD',
                        // Keep price open; contact for pricing via specification (string kept intentionally)
                        'priceSpecification' => [
                            '@type' => 'PriceSpecification',
                            'price' => 'contact for pricing',
                        ],
                        'availability' => 'https://schema.org/InStock',
                    ],
                ],

                // FAQ schema
                [
                    '@type' => 'FAQPage',
                    'mainEntity' => [
                        [
                            '@type' => 'Question',
                            'name' => 'What is Seova?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Seova is an SEO Virtual Assistant agency that combines technical SEO and data analysis to help small and medium businesses grow organically.',
                            ],
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'Who is Seova for?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'We primarily support small and medium businesses looking for practical, ROI-focused SEO without the fluff.',
                            ],
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'What services do you offer?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'We offer site health audits, keyword strategy implementation, ROI-focused campaign analysis, and automated reporting dashboards.',
                            ],
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'How does pricing work?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Services are offered in USD with tailored quotes based on scope. Get a free quote to receive a personalized plan and pricing.',
                            ],
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'Do I need technical skills to use Seova?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'No. We provide simple guidance and do the heavy lifting. Our tools and processes are designed to be easy to use.',
                            ],
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'What happens after I request a quote?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'We review your site, prepare a tailored growth plan, and recommend services aligned with your goals and budget.',
                            ],
                        ],
                        [
                            '@type' => 'Question',
                            'name' => "How can I grow my site's visitors organically?",
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Focus on technical health, intent-driven keyword targeting, high-quality content, and consistent internal linking. We prioritize fixes and strategies that compound growth over time.',
                            ],
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'How long does SEO take to show results?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Most sites begin to see measurable improvements within 6–12 weeks, depending on competition and site health. We set expectations clearly and track leading indicators from week one.',
                            ],
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'Do you help with local SEO and Google Business Profile?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Yes. We optimize your Google Business Profile, local citations, and on-page local signals to improve visibility for searches in your service area.',
                            ],
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'Can you work with my CMS (WordPress, Shopify, custom)?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Absolutely. We regularly work with WordPress, Shopify, Webflow, and custom stacks. We provide implementation-ready recommendations or can implement where access allows.',
                            ],
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'What metrics do you track to measure SEO success?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'We track organic traffic, qualified sessions, rankings for priority keywords, conversions, and ROI signals. Technical KPIs include Core Web Vitals, crawlability, indexation, and error rates.',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
