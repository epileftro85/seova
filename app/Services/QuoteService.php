<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuoteSubmitted;
use App\Models\Quote;

class QuoteService
{
    /**
     * Handle quote submission. If configured to use email, attempt to send; otherwise mock.
     *
     * @param array $data
     * @return array{ok:bool, reference?:string, message?:string}
     */
    public function submitQuote(array $data): array
    {
        // Always generate a reference for tracking
        $reference = Str::uuid()->toString();

        // Email path (basic implementation; can be extended)
        // Follow Laravel standard configs: use global MAIL_FROM_ADDRESS as the business inbox
        $to = config('mail.from.address');
        if (empty($to)) {
            Log::warning('[Quote EMAIL] Missing MAIL_FROM_ADDRESS configuration.', [
                'reference' => $reference,
            ]);
            return [
                'ok' => false,
                'reference' => $reference,
                'message' => 'Email destination not configured. Please set MAIL_FROM_ADDRESS to enable email sending.',
            ];
        }

        try {
            // Persist the quote first
            Quote::create([
                'reference' => $reference,
                'name' => $data['name'] ?? '',
                'email' => $data['email'] ?? '',
                'website' => $data['website'] ?? null,
                'budget' => $data['budget'] ?? '',
                'goal' => $data['goal'] ?? '',
                'message' => $data['message'] ?? null,
                'consent' => isset($data['consent']) && (bool) $data['consent'],
                'status' => 'new',
                'ip' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
            ]);

            Mail::to($to)->send(new QuoteSubmitted($data, $reference));

            return [
                'ok' => true,
                'reference' => $reference,
                'message' => 'Your request has been received. We will contact you shortly.',
            ];
        } catch (\Throwable $e) {
            Log::error('[Quote EMAIL] Failed to send quote email', [
                'reference' => $reference,
                'error' => $e->getMessage(),
            ]);
            return [
                'ok' => false,
                'reference' => $reference,
                'message' => 'We could not send your request right now. Please try again later.',
            ];
        }
    }
}
