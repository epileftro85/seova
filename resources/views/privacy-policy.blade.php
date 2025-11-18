@extends('layouts.app')

@section('title', 'Privacy Policy | Seova Virtual Assistant')
@section('description', 'Learn how Seova collects, uses, and protects information submitted through forms, analytics, and free SEO tools.')
@section('keywords', 'privacy policy, data protection, seova privacy, analytics policy, contact form data')
@section('json-ld')
@endsection

@section('hero')
<section class="bg-gray-900 text-gray-100 py-20 px-6" aria-labelledby="privacy-hero-heading">
    <div class="max-w-4xl mx-auto text-center space-y-4">
        <h1 id="privacy-hero-heading" class="text-4xl font-bold">Privacy Policy</h1>
        <p class="text-lg text-gray-300">Last updated: {{ now()->format('F j, Y') }}</p>
        <p class="text-base text-gray-300 max-w-2xl mx-auto">Seova respects your privacy. This page explains what data we collect, why we collect it, and how you can control your information.</p>
    </div>
</section>
@endsection

@section('content')
<section class="bg-white py-16 px-6" aria-labelledby="privacy-overview">
    <div class="max-w-4xl mx-auto space-y-8 text-gray-700">
        <article class="space-y-3">
            <h2 id="privacy-overview" class="text-2xl font-semibold text-seova-orange">1. Who We Are</h2>
            <p>Seova is a data-driven SEO virtual assistant service operated in the United States. You can reach us directly at <a href="mailto:{{ config('mail.from.address') ?? 'hello@seova.pro' }}" class="text-seova-orange underline hover:text-seova-orange/80">{{ config('mail.from.address') ?? 'hello@seova.pro' }}</a>.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">2. Information We Collect</h2>
            <ul class="list-disc pl-6 space-y-2">
                <li><strong>Contact Form Submissions:</strong> Name, email, website URL, business goals, and optional message shared via the quote form.</li>
                <li><strong>Analytics Data:</strong> Aggregate usage data via Google Analytics 4, including page views, device details, and interactions.</li>
                <li><strong>Advertising Data:</strong> Google Ads tags may capture page visits, conversions, and limited demographic segments to measure campaign effectiveness and deliver relevant ads.</li>
                <li><strong>Free Tool Usage:</strong> Inputs entered into our free SEO tools are processed client-side and stored only temporarily to deliver results.</li>
            </ul>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">3. How We Use Your Information</h2>
            <ul class="list-disc pl-6 space-y-2">
                <li>Respond to contact requests and prepare custom proposals.</li>
                <li>Improve website performance and prioritize new features.</li>
                <li>Monitor usage of free tools to ensure reliability and prevent abuse.</li>
            </ul>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">4. Data Sharing &amp; Retention</h2>
            <p>We do not sell your data. We may share it with trusted processors such as hosting providers, analytics platforms, Google Ads (for remarketing and conversion tracking), or CRM tools strictly to deliver our services. Quote submissions are retained for up to 18 months unless you request deletion. Analytics and advertising data are retained according to the defaults of the respective platforms.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">5. Cookies &amp; Tracking</h2>
            <p>We use first-party and third-party cookies to enable core functionality (such as remembering form states) and to gather aggregated analytics. Google Ads cookies may track visits and conversions to personalize ads and measure campaign performance. You can disable or manage cookies in your browser settings, though some features may not function as intended.</p>
            <p>If you prefer to opt out of Google Ads personalization, visit <a href="https://adssettings.google.com" class="text-seova-orange underline hover:text-seova-orange/80" rel="noopener" target="_blank">Google’s Ads Settings</a> or use industry opt-out tools such as the <a href="https://optout.networkadvertising.org" class="text-seova-orange underline hover:text-seova-orange/80" rel="noopener" target="_blank">Network Advertising Initiative</a>.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">6. Your Rights</h2>
            <p>You can request access, updates, or deletion of your personal information by emailing <a href="mailto:{{ config('mail.from.address') ?? 'hello@seova.pro' }}" class="text-seova-orange underline hover:text-seova-orange/80">{{ config('mail.from.address') ?? 'hello@seova.pro' }}</a>. We respond within 30 days.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">7. Changes to This Policy</h2>
            <p>We may update this Privacy Policy to reflect new regulations or service updates. We will revise the “Last updated” date and highlight material changes on this page.</p>
        </article>
    </div>
</section>
@endsection
