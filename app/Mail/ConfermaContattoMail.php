<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfermaContattoMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $name) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Abbiamo ricevuto la tua richiesta — Corvalys',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.conferma-contatto',
            with: ['name' => $this->name],
        );
    }
}
