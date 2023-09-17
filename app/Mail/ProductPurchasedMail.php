<?php

namespace App\Mail;

use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProductPurchasedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Purchase $purchase;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Product Purchased',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.product-purchased',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
