<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NuovoLeadMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Lead $lead) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuovo contatto — ' . $this->lead->service_type . ' | ' . $this->lead->budget_range,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.nuovo-lead',
            with: ['lead' => $this->lead],
        );
    }
}
