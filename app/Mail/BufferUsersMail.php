<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BufferUsersMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $lastname;
    public string $token;
    public int $id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $token,string $lastname , int $id)
    {
        $this->token = $token;
        $this->lastname = $lastname;
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope():Envelope
    {
        return new Envelope(
            from: new Address('no-reply@boba-shop.fr','Boba Shop'),
            subject: 'Formulaire Verifications Email',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content() : Content
    {
        return new Content(
            view: 'mail.BufferUsersView',
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
