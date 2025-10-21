@extends('layouts.app')

@section('title', 'Terms of Service | Seova Virtual Assistant')
@section('description', 'Review the terms governing your use of Seova’s SEO services, free tools, and website content.')
@section('keywords', 'terms of service, user agreement, seova terms, seo tool terms, liability disclaimer')

@section('hero')
<section class="bg-gray-900 text-gray-100 py-20 px-6" aria-labelledby="terms-hero-heading">
    <div class="max-w-4xl mx-auto text-center space-y-4">
        <h1 id="terms-hero-heading" class="text-4xl font-bold">Terms of Service</h1>
        <p class="text-lg text-gray-300">Last updated: {{ now()->format('F j, Y') }}</p>
        <p class="text-base text-gray-300 max-w-2xl mx-auto">By accessing Seova services and tools, you agree to the responsibilities and limitations outlined on this page.</p>
    </div>
</section>
@endsection

@section('content')
<section class="bg-white py-16 px-6" aria-labelledby="terms-overview">
    <div class="max-w-4xl mx-auto space-y-8 text-gray-700">
        <article class="space-y-3">
            <h2 id="terms-overview" class="text-2xl font-semibold text-seova-orange">1. Acceptance of Terms</h2>
            <p>Seova provides SEO consulting services and free tools subject to these Terms of Service. By using our website, submitting forms, or accessing our tools, you agree to follow these terms and any applicable laws.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">2. Services &amp; Scope</h2>
            <ul class="list-disc pl-6 space-y-2">
                <li><strong>Consulting Engagements:</strong> Service scope, deliverables, and payment terms are defined in individual proposals.</li>
                <li><strong>Free Tools:</strong> Tools are provided “as is” for informational purposes. Results should be validated before implementing critical changes.</li>
                <li><strong>Content:</strong> Articles, guides, and templates are offered for general education and do not guarantee performance outcomes.</li>
                <li><strong>Advertising:</strong> We display Google Ads to help fund free tools. Google may collect device data, visit history, or inferred interests to personalize ads and measure conversions.</li>
            </ul>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">3. User Responsibilities</h2>
            <ul class="list-disc pl-6 space-y-2">
                <li>Provide accurate information when requesting quotes or using our tools.</li>
                <li>Maintain the confidentiality of any account or access details provided.</li>
                <li>Use free tools within legal and ethical boundaries; automated scraping or bulk requests are prohibited.</li>
            </ul>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">4. Disclaimers &amp; Liability</h2>
            <p>Seova disclaims all warranties, express or implied. We are not liable for indirect, incidental, or consequential damages resulting from the use of our services or tools. For paid engagements, liability is limited to fees paid in the preceding 90 days.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">5. Advertising &amp; Third-Party Services</h2>
            <p>Our site uses Google Ads remarketing and conversion tracking. By accessing the site you consent to the processing of device identifiers, cookie data, and interaction metrics by Google in accordance with their privacy policy. You may manage your ad preferences at <a href="https://adssettings.google.com" class="text-seova-orange underline hover:text-seova-orange/80" rel="noopener" target="_blank">Google’s Ads Settings</a> or opt out through the <a href="https://optout.networkadvertising.org" class="text-seova-orange underline hover:text-seova-orange/80" rel="noopener" target="_blank">Network Advertising Initiative</a>.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">6. Intellectual Property</h2>
            <p>All content, branding, and tool code are owned by Seova unless otherwise noted. You may not reproduce or redistribute these materials without permission, except for personal internal use.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">7. Termination</h2>
            <p>We reserve the right to suspend or terminate access to our services or tools if we detect misuse, security risks, or violations of these terms.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">8. Governing Law</h2>
            <p>These Terms are governed by the laws of the State of Illinois, United States, without regard to conflict-of-law principles. Disputes will be resolved through good-faith negotiations before considering formal proceedings.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">9. Contact</h2>
            <p>Questions about these Terms can be directed to <a href="mailto:{{ config('mail.from.address') ?? 'hello@seova.pro' }}" class="text-seova-orange underline hover:text-seova-orange/80">{{ config('mail.from.address') ?? 'hello@seova.pro' }}</a>.</p>
        </article>
    </div>
</section>
@endsection
