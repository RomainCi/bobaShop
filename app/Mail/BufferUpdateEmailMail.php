<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BufferUpdateEmailMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $token;
    public int $id;

    /**
     * Create a new message instance.
     *
     * @param string $token
     * @param int $id
     * @return void
     */
    public function __construct(string $token, int $id)
    {
        $this->token = $token;
        $this->id = $id;
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
            subject: 'Changement Email',
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
            view: 'mail.BufferUpdateEmailView',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
