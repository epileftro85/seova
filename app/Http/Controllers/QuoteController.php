<?php

namespace App\Http\Controllers;

use App\Services\QuoteService;
use App\Services\MetaConversionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function __construct(
        private readonly QuoteService $quoteService,
        private readonly MetaConversionService $metaService
    ) {}

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'website' => ['nullable', 'url', 'max:255'],
            'budget' => ['required', 'string', 'max:50'],
            'goal' => ['required', 'string', 'max:60'],
            'message' => ['nullable', 'string', 'max:2000'],
            'consent' => ['accepted'],
            'meta_event_id' => ['nullable', 'string', 'max:100'],
            // honeypot must be empty
            'company' => ['nullable', 'max:0'],
        ], [
            'company.max' => 'Invalid submission.',
        ]);

        $result = $this->quoteService->submitQuote($validated);

        if ($result['ok']) {
            try {
                $this->metaService->sendLeadEvent([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ], $validated['meta_event_id'] ?? null);
            } catch (\Exception $e) {
                // Logged internally by service, continue flow
            }
        }

        $redirectUrl = route('home') . '#contact';
        return redirect($redirectUrl)
            ->with('quote_status', $result['ok'] ? 'success' : 'error')
            ->with('quote_message', $result['message'] ?? null)
            ->with('quote_reference', $result['reference'] ?? null)
            ->withInput(!$result['ok'] ? $request->except(['consent', 'meta_event_id']) : []);
    }
}
