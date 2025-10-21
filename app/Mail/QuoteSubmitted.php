<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(
        public array $data,
        public string $reference,
    ) {
        // If later you persist quotes, consider $this->afterCommit();
    }

    public function envelope(): Envelope
    {
        $replyTos = [];
        $replyEmail = $this->data['email'] ?? null;
        $replyName = $this->data['name'] ?? null;
        if (!empty($replyEmail)) {
            $replyTos[] = new Address($replyEmail, $replyName);
        }

        return new Envelope(
            subject: 'New SEO Quote Request',
            replyTo: $replyTos,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.quote-submitted',
            with: [
                'reference' => $this->reference,
                'data' => $this->data,
            ],
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
