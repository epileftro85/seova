<!-- Get a Quote Form -->
<section id="contact" class="bg-gray-50 py-20 px-6" aria-labelledby="quote-heading">
    <div class="max-w-3xl mx-auto">
        <h2 id="quote-heading" class="text-3xl font-bold text-center mb-3">Get a Free SEO Quote</h2>
        <p class="text-gray-600 text-center mb-10">Tell us a bit about your business and goals. We’ll review your site and send a tailored plan with clear next steps and pricing in USD.</p>

        <form method="POST" action="{{ route('quote.store') }}" class="bg-white shadow rounded-xl p-6 md:p-8" aria-describedby="quote-help quote-status">
            @csrf
            <p id="quote-help" class="sr-only">All fields marked with an asterisk (*) are required.</p>

            @if(session('quote_status'))
                <div id="quote-status" class="mb-6 rounded-md {{ session('quote_status')==='success' ? 'bg-seova-green/10 text-seova-green' : 'bg-red-50 text-red-800' }} p-4" role="status" aria-live="polite">
                    <p class="text-sm">
                        {{ session('quote_message') ?? (session('quote_status')==='success' ? 'Thanks! We received your request.' : 'We could not send your request right now.') }}
                        @if(session('quote_reference'))
                            <br><span class="font-medium">Reference:</span> {{ session('quote_reference') }}
                        @endif
                    </p>
                </div>
            @endif

            @include('partials.quote-form-fields', ['idPrefix' => ''])
        </form>
    </div>
</section>
