<?php

namespace App\Mail;

use App\Models\CompanySymbol;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $message, public $attachment)
    {
        $this->getCompanyName($message->symbol);
    }

    private function getCompanyName($symbol)
    {
        $company = CompanySymbol::where('symbol', $symbol)->first();

        $this->subject = $company->name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noreply@xm.com', 'XM.com'),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.index',
            with: [
                'company_name' => $this->subject,
                'start_date' => $this->message->start_date,
                'end_date' => $this->message->end_date
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->attachment),
        ];
    }
}
