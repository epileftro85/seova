<div id="quoteModalWrapper"
     class="fixed inset-0 z-[100] flex items-center justify-center p-4 hidden"
     aria-labelledby="quote-modal-title" aria-describedby="quote-modal-desc" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div data-modal-backdrop class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" aria-hidden="true"></div>

    <!-- Dialog -->
    <div data-modal-dialog class="relative w-full max-w-2xl bg-white rounded-xl shadow-lg ring-1 ring-gray-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-seova-orange focus-visible:ring-offset-2 overflow-y-auto max-h-[90vh]">
        <button type="button" data-modal-close class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2 rounded" aria-label="Close quote form dialog">
            <svg class="w-5 h-5" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="M6 6l12 12"/></svg>
        </button>
        <div class="p-6 md:p-8">
            <h2 id="quote-modal-title" class="text-2xl font-bold mb-2">Get a Free SEO Quote</h2>
            <p id="quote-modal-desc" class="text-sm text-gray-600 mb-6">Answer a few quick questions—no obligation. We’ll email a personalized growth plan.</p>
            <form method="POST" action="{{ route('quote.store') }}" class="space-y-6" aria-describedby="quote-help-modal">
                @csrf
                <p id="quote-help-modal" class="sr-only">All required fields are marked with an asterisk.</p>
                @include('partials.quote-form-fields', ['idPrefix' => 'modal_'])
            </form>
        </div>
    </div>
</div>
