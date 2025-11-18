@extends('layouts.app')

@section('title', 'Refund Policy | Seova Virtual Assistant')
@section('description', 'Review Seova\'s refund policy for SEO services, including cancellations, billing errors, and non-refundable items.')
@section('keywords', 'refund policy, seova refund, cancellation policy, billing errors, service refunds')

@section('json-ld')
@endsection

@section('hero')
<section class="bg-gray-900 text-gray-100 py-20 px-6" aria-labelledby="refund-hero-heading">
    <div class="max-w-4xl mx-auto text-center space-y-4">
        <h1 id="refund-hero-heading" class="text-4xl font-bold">Refund Policy</h1>
        <p class="text-lg text-gray-300">Last updated: {{ now()->format('F j, Y') }}</p>
        <p class="text-base text-gray-300 max-w-2xl mx-auto">At Seova, we strive to provide high-quality SEO and digital marketing services. Learn about our refund and cancellation policies.</p>
    </div>
</section>
@endsection

@section('content')
<section class="bg-white py-16 px-6" aria-labelledby="refund-overview">
    <div class="max-w-4xl mx-auto space-y-8 text-gray-700">
        <article class="space-y-3">
            <h2 id="refund-overview" class="text-2xl font-semibold text-seova-orange">1. General Policy</h2>
            <p>Due to the nature of SEO services, all sales are final. Because our services involve manual labor, strategic planning, and digital deliverables that cannot be "returned," once a service has been initiated or a billing cycle has started, we do not offer refunds for work already performed or for time already invested in your project.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">2. Service Cancellations</h2>
            <p>You may cancel your subscription or service agreement at any time.</p>
            <ul class="list-disc pl-6 space-y-2">
                <li><strong>Monthly Subscriptions:</strong> To avoid being charged for the next billing cycle, you must cancel at least 5 business days before your next renewal date.</li>
                <li>Upon cancellation, your service will remain active until the end of the current paid period, and no further charges will be applied.</li>
            </ul>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">3. Non-Refundable Items</h2>
            <p>Refunds will not be issued for:</p>
            <ul class="list-disc pl-6 space-y-2">
                <li>Setup fees or initial audit costs.</li>
                <li>Months of service already completed or currently in progress.</li>
                <li>Third-party costs (e.g., paid tools, backlinks, or content creation) already purchased on your behalf.</li>
                <li>Discounts or promotional credits.</li>
            </ul>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">4. Errors and Duplicate Charges</h2>
            <p>We value your trust. If you notice a billing error or a duplicate charge, please contact us immediately at <a href="mailto:info@seova.pro" class="text-seova-orange underline hover:text-seova-orange/80">info@seova.pro</a>. In such cases, we will investigate and, if a technical error is confirmed, we will process a full refund for the mistaken amount within 7-10 business days.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">5. Chargebacks</h2>
            <p>We encourage our clients to contact us directly to resolve any issues. According to our terms, any unauthorized chargebacks will result in the immediate termination of services and may be reported to credit agencies.</p>
        </article>
        <article class="space-y-3">
            <h2 class="text-2xl font-semibold text-seova-orange">6. Contact Us</h2>
            <p>If you have any questions about our Refund Policy, please reach out to our support team:</p>
            <ul class="list-none space-y-2 mt-3">
                <li><strong>Email:</strong> <a href="mailto:info@seova.pro" class="text-seova-orange underline hover:text-seova-orange/80">info@seova.pro</a></li>
                <li><strong>Website:</strong> <a href="https://seova.pro/" class="text-seova-orange underline hover:text-seova-orange/80" rel="noopener" target="_blank">https://seova.pro/</a></li>
            </ul>
        </article>
    </div>
</section>
@endsection
