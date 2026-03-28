<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProposalMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Lead $lead,
        public string $proposalSubject,
        public string $bodyText,
        public bool $includeAssessment = false,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->proposalSubject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.proposal',
            with: [
                'lead' => $this->lead,
                'bodyText' => $this->bodyText,
                'includeAssessment' => $this->includeAssessment,
                'assessment' => $this->includeAssessment ? $this->lead->claude_auto_assessment : null,
            ],
        );
    }
}
