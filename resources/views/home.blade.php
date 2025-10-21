@extends('layouts.app')

@section('title', 'Seova SEO Virtual Assistant for Small Business')
@section('description', 'Seova provides smart SEO solutions for small businesses. Get technical site audits, keyword strategy, ROI-focused campaigns, and automated reporting dashboards.')
@section('keywords', 'SEO virtual assistant, technical SEO audit, keyword strategy, ROI campaign analysis, automated SEO reporting, small business SEO')

@section('og_title', 'Seova – Smart SEO Solutions for Small Business Growth')
@section('og_description', 'Technical expertise and data analysis to help small businesses grow organically. Site health audits, keyword strategy, and automated reporting.')
@section('og_type', 'website')

@section('twitter_title', 'Seova – Smart SEO, Simple Execution, Real Growth')
@section('twitter_description', 'SEO Virtual Assistant combining technical expertise with data analysis for small business growth.')

@php $showCTA = true; @endphp

@section('json-ld')
<script type="application/ld+json">@json($structuredData, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
@endsection

@section('hero')
<!-- Hero Section -->
<section class="bg-white relative" aria-labelledby="hero-heading">
    <div class="max-w-7xl mx-auto px-6 py-20 text-center">
        <h1 id="hero-heading" class="text-5xl font-bold text-gray-900 mb-4">Smart SEO - Simple execution, Real growth.</h1>
        <p class="text-lg text-gray-600 mb-6">Seova is your SEO Virtual Assistant, combining technical expertise and data analysis to help small businesses grow organically. No fluff. Just results.</p>
    <a href="{{ url('/') }}#contact" class="inline-block bg-seova-green text-white font-semibold px-6 py-3 rounded-lg hover:bg-seova-green transition focus:outline-none focus:ring-2 focus:ring-seova-green focus:ring-offset-2" aria-label="Get a free SEO quote from Seova - Simple, fast, and tailored to your business" data-analytics-event="hero_cta_quote">Get a Free Quote</a>
        <p class="mt-2 text-sm text-gray-500">Simple, fast, and tailored to your business.</p>
    </div>

    <!-- Decorative Wave Divider -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none rotate-180" aria-hidden="true">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-20">
            <path d="M0,0V46.29c47.59,22,103.77,29.05,158,17.26C255.58,45.6,320,0,400,0s144.42,45.6,242,63.55c54.23,11.79,110.41,4.74,158-17.26V0Z" fill="#f9fafb"></path>
        </svg>
    </div>
</section>
@endsection

@section('content')
<!-- Services Section -->
<section id="services" class="bg-gray-50 pt-24 pb-16 px-6" aria-labelledby="services-heading">
    <div class="max-w-7xl mx-auto">
        <h2 id="services-heading" class="sr-only">Our SEO Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            <article class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="mb-4 flex justify-center" aria-hidden="true">
                    <!-- Monochrome (gray) Wrench icon -->
                    <svg class="w-12 h-12 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" role="img" aria-label="" focusable="false">
                        <path d="M15.59 14.37a6 6 0 0 0-7.22-7.22l2.53 2.53a3 3 0 1 1-4.24 4.24l-2.53-2.53a6 6 0 0 0 7.22 7.22l5.68 5.68a1.5 1.5 0 0 0 2.12-2.12l-5.68-5.68z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-seova-orange mb-2">Site Health Audits</h3>
                <p>Technical diagnostics to keep your website fast, secure, and optimized.</p>
            </article>
            <article class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="mb-4 flex justify-center" aria-hidden="true">
                    <!-- Monochrome (gray) Bar Chart icon -->
                    <svg class="w-12 h-12 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" role="img" aria-label="" focusable="false">
                        <path d="M3 3v18h18" />
                        <path d="M7 16V8" />
                        <path d="M13 16V4" />
                        <path d="M19 21V12" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-seova-orange mb-2">ROI-Focused Campaign Analysis</h3>
                <p>Track your marketing spend and see what's actually working.</p>
            </article>
            <article class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="mb-4 flex justify-center" aria-hidden="true">
                    <!-- Monochrome (gray) Light Bulb / Strategy icon -->
                    <svg class="w-12 h-12 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" role="img" aria-label="" focusable="false">
                        <path d="M12 2a7 7 0 0 0-4 12.9V18a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-3.1A7 7 0 0 0 12 2z" />
                        <path d="M9 22h6" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-seova-orange mb-2">Keyword Strategy Implementation</h3>
                <p>Target the right keywords with precision and measurable results.</p>
            </article>
            <article class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="mb-4 flex justify-center" aria-hidden="true">
                    <!-- Monochrome (gray) Trending Up / Growth icon -->
                    <svg class="w-12 h-12 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" role="img" aria-label="" focusable="false">
                        <path d="M3 17l6-6 4 4 8-8" />
                        <path d="M14 5h7v7" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-seova-orange mb-2">Automated Reporting Dashboards</h3>
                <p>Custom dashboards that turn your data into decisions. No spreadsheets required.</p>
            </article>
        </div>
    </div>
</section>
@endsection

@section('additional-sections')
<!-- Free Tools Section -->
<section class="bg-white py-20 px-6 text-center" aria-labelledby="tools-heading">
    <div class="max-w-6xl mx-auto">
        <h2 id="tools-heading" class="text-3xl font-bold mb-4">Free SEO tools for everyone.</h2>
        <p class="text-lg text-gray-600 mb-8 max-w-3xl mx-auto">We believe powerful tools should be accessible. That's why we're building a suite of free SEO tools — supported by Google Ads, not your wallet.</p>
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" role="list">
            {{--<li>
                <a href="{{ route('tools.keyword') }}" class="group block bg-gray-100 hover:bg-gray-200 focus:bg-gray-200 transition p-6 rounded-lg outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2 h-full" aria-describedby="tool-keyword-desc" data-analytics-event="home_tools_keyword">
                    <div class="flex flex-col items-center gap-3">
                        <svg class="w-10 h-10 text-gray-500 group-hover:text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                            <path d="M15.59 14.37a6 6 0 0 0-7.22-7.22l2.53 2.53a3 3 0 1 1-4.24 4.24l-2.53-2.53a6 6 0 0 0 7.22 7.22l5.68 5.68a1.5 1.5 0 0 0 2.12-2.12l-5.68-5.68z" />
                        </svg>
                        <strong class="text-gray-800">Keyword Explorer</strong>
                        <p id="tool-keyword-desc" class="text-xs text-gray-500 text-center">Generate keyword idea variations.</p>
                    </div>
                </a>
            </li>--}}

            {{--<li>
                <a href="{{ route('tools.crawler') }}" class="group block bg-gray-100 hover:bg-gray-200 focus:bg-gray-200 transition p-6 rounded-lg outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2 h-full" aria-describedby="tool-crawler-desc" data-analytics-event="home_tools_crawler">
                    <div class="flex flex-col items-center gap-3">
                        <svg class="w-10 h-10 text-gray-500 group-hover:text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                            <path d="M12 2v4" />
                            <path d="M12 18v4" />
                            <path d="M4.93 4.93l2.83 2.83" />
                            <path d="M16.24 16.24l2.83 2.83" />
                            <path d="M2 12h4" />
                            <path d="M18 12h4" />
                            <path d="M4.93 19.07l2.83-2.83" />
                            <path d="M16.24 7.76l2.83-2.83" />
                            <circle cx="12" cy="12" r="3.5" />
                        </svg>
                        <strong class="text-gray-800">Site Crawler</strong>
                        <p id="tool-crawler-desc" class="text-xs text-gray-500 text-center">Discover internal links (prototype).</p>
                    </div>
                </a>
            </li>--}}
            <li>
                <a href="{{ route('tools.serp') }}" class="group block bg-gray-100 hover:bg-gray-200 focus:bg-gray-200 transition p-6 rounded-lg outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2 h-full" aria-describedby="tool-serp-desc" data-analytics-event="home_tools_serp">
                    <div class="flex flex-col items-center gap-3">
                        <svg class="w-10 h-10 text-gray-500 group-hover:text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                            <circle cx="11" cy="11" r="7" />
                            <path d="M21 21l-4.35-4.35" />
                            <path d="M8 11h6" />
                            <path d="M8 8h3" />
                        </svg>
                        <strong class="text-gray-800">SERP Preview</strong>
                        <p id="tool-serp-desc" class="text-xs text-gray-500 text-center">Simulate Google result snippet.</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('tools.word-counter') }}" class="group block bg-gray-100 hover:bg-gray-200 focus:bg-gray-200 transition p-6 rounded-lg outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2 h-full" aria-describedby="tool-word-counter-desc" data-analytics-event="home_tools_word_counter">
                    <div class="flex flex-col items-center gap-3">
                        <svg class="w-10 h-10 text-gray-500 group-hover:text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                            <path d="M10 13a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-6z" />
                            <path d="M10 3h4v4h-4z" />
                            <path d="M4 17h16" />
                        </svg>
                        <strong class="text-gray-800">Word Counter</strong>
                        <p id="tool-word-counter-desc" class="text-xs text-gray-500 text-center">Count words and characters in a text.</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('tools.meta-tag-generator') }}" class="group block bg-gray-100 hover:bg-gray-200 focus:bg-gray-200 transition p-6 rounded-lg outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2 h-full" aria-describedby="tool-meta-tag-generator-desc" data-analytics-event="home_tools_meta_tag_generator">
                    <div class="flex flex-col items-center gap-3">
                        <svg class="w-10 h-10 text-gray-500 group-hover:text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                            <path d="M12 15l-4-4h8l-4 4z" />
                            <path d="M12 3v8" />
                        </svg>
                        <strong class="text-gray-800">Meta Tag Generator</strong>
                        <p id="tool-meta-tag-generator-desc" class="text-xs text-gray-500 text-center">Generate meta tags for your website.</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('tools.json-schema-validator') }}" class="group block bg-gray-100 hover:bg-gray-200 focus:bg-gray-200 transition p-6 rounded-lg outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2 h-full" aria-describedby="tool-json-schema-validator-desc" data-analytics-event="home_tools_json_schema_validator">
                    <div class="flex flex-col items-center gap-3">
                        <svg class="w-10 h-10 text-gray-500 group-hover:text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <path d="M14 2v6h6M10 13L8 15l2 2M14 13l2 2-2 2" />
                        </svg>
                        <strong class="text-gray-800">JSON Schema Validator</strong>
                        <p id="tool-json-schema-validator-desc" class="text-xs text-gray-500 text-center">Validate your JSON-LD schemas.</p>
                    </div>
                </a>
            </li>
        </ul>
        <p class="mt-6 text-sm text-gray-500">These tools are forever free. No login. No limits.</p>
    </div>
</section>

<!-- About Section -->
<section class="max-w-5xl mx-auto px-6 py-20 text-center" aria-labelledby="about-heading">
    <h2 id="about-heading" class="text-3xl font-bold mb-4">Built by a tech strategist and a data analyst — for small businesses.</h2>
    <p class="text-lg text-gray-600">Seova is a husband-and-wife team with a shared mission: help entrepreneurs grow online without wasting time or money. We blend technical SEO implementation with deep data insights to deliver measurable growth.</p>
    <p class="mt-4 text-gray-600">Whether you're launching your first site or scaling your digital presence, we're here to guide you with clarity, speed, and results.</p>
</section>

<!-- FAQ Section -->
<section class="max-w-4xl mx-auto px-6 py-16" aria-labelledby="faq-heading">
    <h2 id="faq-heading" class="text-3xl font-bold text-center mb-10">Frequently Asked Questions</h2>
    <ul class="space-y-6">
        <li class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-seova-orange mb-2">What makes Seova different?</h3>
            <p>We combine technical SEO expertise with deep data analysis to deliver growth you can measure.</p>
        </li>
        <li class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-seova-orange mb-2">Can I use Seova without technical skills?</h3>
            <p>Absolutely. Our tools are built for simplicity, and we guide you every step of the way.</p>
        </li>
        <li class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-seova-orange mb-2">Are the SEO tools really free?</h3>
            <p>Yes — supported by ads, not subscriptions. Use them anytime, no login required.</p>
        </li>
        <li class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-seova-orange mb-2">What happens when I request a quote?</h3>
            <p>We'll review your site, send a personalized growth plan, and suggest services that fit your goals.</p>
        </li>
    </ul>
</section>

@include('partials.quote-form')
@endsection
