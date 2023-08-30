<?php

namespace App\Mail;

use App\Models\Invoices;
use App\Models\Orders;
use Barryvdh\DomPDF\PDF;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class InvoiceMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Invoices $invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invoices $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('no-reply@bobashop.fr'),
            subject: 'facture',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.InvoiceEmailView',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        $contents = Storage::disk('s3')->get($this->invoice->path);
        return [
            Attachment::fromData(fn() => $contents, $this->invoice->number . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
