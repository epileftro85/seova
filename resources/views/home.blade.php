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

@section('meta')
<script type="application/ld+json">@json($structuredData, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
@endsection

@section('hero')
<!-- Hero Section -->
<section class="bg-white relative" aria-labelledby="hero-heading">
    <div class="max-w-7xl mx-auto px-6 py-20 text-center">
        <h1 id="hero-heading" class="text-5xl font-bold text-gray-900 mb-4">Smart SEO - Simple execution, Real growth.</h1>
        <p class="text-lg text-gray-600 mb-6">Seova is your SEO Virtual Assistant, combining technical expertise and data analysis to help small businesses grow organically. No fluff. Just results.</p>
    <a href="{{ url('/') }}#contact" class="inline-block bg-seova-green text-white font-semibold px-6 py-3 rounded-lg hover:bg-seova-green transition focus:outline-none focus:ring-2 focus:ring-seova-green focus:ring-offset-2" aria-label="Get a free SEO quote from Seova - Simple, fast, and tailored to your business">Get a Free Quote</a>
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
                <div class="text-4xl mb-4" role="img" aria-label="Medical stethoscope icon">🩺</div>
                <h3 class="text-xl font-semibold text-seova-orange mb-2">Site Health Audits</h3>
                <p>Technical diagnostics to keep your website fast, secure, and optimized.</p>
            </article>
            <article class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-4xl mb-4" role="img" aria-label="Bar chart icon">📊</div>
                <h3 class="text-xl font-semibold text-seova-orange mb-2">ROI-Focused Campaign Analysis</h3>
                <p>Track your marketing spend and see what's actually working.</p>
            </article>
            <article class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-4xl mb-4" role="img" aria-label="Brain icon">🧠</div>
                <h3 class="text-xl font-semibold text-seova-orange mb-2">Keyword Strategy Implementation</h3>
                <p>Target the right keywords with precision and measurable results.</p>
            </article>
            <article class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-4xl mb-4" role="img" aria-label="Growth chart icon">📈</div>
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
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <li class="bg-gray-100 p-6 rounded-lg">
                <span role="img" aria-label="Wrench tool icon">🔧</span>
                <strong>Keyword Explorer</strong>
            </li>
            <li class="bg-gray-100 p-6 rounded-lg">
                <span role="img" aria-label="Test tube icon">🧪</span>
                <strong>Meta Tag Analyzer</strong>
            </li>
            <li class="bg-gray-100 p-6 rounded-lg">
                <span role="img" aria-label="Spider web icon">🕷️</span>
                <strong>Site Crawler</strong>
            </li>
            <li class="bg-gray-100 p-6 rounded-lg">
                <span role="img" aria-label="Ruler icon">📐</span>
                <strong>SERP Preview Generator</strong>
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