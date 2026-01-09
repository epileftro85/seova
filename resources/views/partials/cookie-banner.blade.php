<div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-gray-900/95 text-white p-4 z-50 transform transition-transform duration-300 translate-y-full" style="display: none;" role="alert" aria-live="polite">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="text-sm text-gray-300 flex-1">
            <p>
                We use cookies and tracking technologies to improve your experience, analyze traffic, and show relevant ads. 
                By clicking "Accept", you consent to our use of these technologies. 
                <a href="{{ url('/privacy-policy') }}" class="text-seova-orange underline hover:text-seova-orange/80">Privacy Policy</a>
            </p>
        </div>
        <div class="flex gap-3 shrink-0">
            <button id="cookie-decline" class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-800 rounded transition-colors">
                Decline
            </button>
            <button id="cookie-accept" class="px-4 py-2 text-sm font-medium bg-seova-orange text-white hover:bg-orange-600 rounded shadow-sm transition-colors">
                Accept All
            </button>
        </div>
    </div>
</div>
