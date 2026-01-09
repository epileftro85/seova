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
            <h2 class="text-2xl font-semibold text-seova-orange">5. Cookies &amp; Tracking Technologies</h2>
            <p>We use cookies, pixels, and similar tracking technologies to enable core functionality, analyze website traffic, and support our marketing efforts.</p>
            
            <h3 class="text-xl font-medium text-gray-800">Meta Pixel &amp; Conversion API</h3>
            <p>We use the Meta Pixel and Conversion API to understand how visitors interact with our website and to measure the effectiveness of our advertising on Facebook and Instagram. This may include tracking actions such as page views, form submissions, and button clicks.</p>
            <p>Data collected may be used for:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li>Measuring the results of our ad campaigns.</li>
                <li>Showing you relevant ads on Meta platforms (Retargeting).</li>
                <li>Creating "Lookalike Audiences" to find new potential customers.</li>
            </ul>
            <p>You can adjust your Facebook ad preferences in your <a href="https://www.facebook.com/adpreferences/ad_settings" class="text-seova-orange underline hover:text-seova-orange/80" rel="noopener" target="_blank">Facebook Ad Settings</a>.</p>

            <h3 class="text-xl font-medium text-gray-800 mt-4">Cookie Consent</h3>
            <p>When you visit our site, we provide you with the option to accept or decline non-essential cookies. You can update your preferences at any time by clearing your browser cookies for this domain.</p>
            <p>If you prefer to opt out of Google Ads personalization, visit <a href="https://adssettings.google.com" class="text-seova-orange underline hover:text-seova-orange/80" rel="noopener" target="_blank">Google’s Ads Settings</a> or use industry opt-out tools such as the <a href="https://optout.networkadvertising.org" class="text-seova-orange underline hover:text-seova-orange/80" rel="noopener" target="_blank">Network Advertising Initiative</a>.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">6. Your Rights</h2>
            <p>You can request access, updates, or deletion of your personal information by emailing <a href="mailto:{{ config('mail.from.address') ?? 'hello@seova.pro' }}" class="text-seova-orange underline hover:text-seova-orange/80">{{ config('mail.from.address') ?? 'hello@seova.pro' }}</a>. We respond within 30 days.</p>
            <p class="text-sm text-gray-600 mt-2"><strong>For residents of Colombia:</strong> In accordance with Statutory Law 1581 of 2012 (Habeas Data), you have the right to know, update, and rectify your personal data, as well as to revoke consent for its use.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">7. Changes to This Policy</h2>
            <p>We may update this Privacy Policy to reflect new regulations or service updates. We will revise the “Last updated” date and highlight material changes on this page.</p>
        </article>
    </div>
</section>
@endsection
