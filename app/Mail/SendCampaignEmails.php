<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Headers;

class SendCampaignEmails extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private $mailData)
    {
        //
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->mailData['from']['email'], $this->mailData['from']['name']),
            replyTo: [
                new Address($this->mailData['replyTo']['email'], $this->mailData['replyTo']['name']),
            ],
            subject: $this->mailData['subject'],
        );
    }
    public function headers(): Headers
    {
        return new Headers(
            text: [
                'List-Unsubscribe' => env('APP_URL') . '/unsubscribe/?email=' . $this->mailData['to']['email'],
            ],
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
            view: 'mail.base',
            with: ['body' => $this->mailData['body']],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];
        if(isset($this->mailData['attachments']))
        foreach ($this->mailData['attachments'] as $attachment) {
            array_push($attachment, Attachment::fromStorage($attachment['path'])
                ->as($attachment['name'])
                ->withMime($attachment['mime']));
        };
        return $attachments;
    }
}
