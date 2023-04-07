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
use Symfony\Component\Mime\Header\PathHeader;


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
            messageId: $this->mailData['messageId'] . '@consultile-mea.com',
            text: [
                'X-SES-CONFIGURATION-SET' => 'consultile_set',
                'X-Confirm-Reading-To' => '<' . env('MAIL_RESPONE_ADDRESS', 'consultilemea@gmail.com') . '>',
                'Disposition-Notification-To' => '<' . env('MAIL_RESPONE_ADDRESS', 'consultilemea@gmail.com') . '>',
                'List-Unsubscribe' => 'subscribe.' . env('APP_DOMAIN', 'consultile.com') . '/unsubscribe/?t=' . $this->mailData['messageId'] ,
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
            text: 'mail.text',
            html: 'mail.base',
            with: ['body' => $this->mailData['body'],
             'tracking' => $this->mailData['tracking'],
             'trackingId' => $this->mailData['messageId']],
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
        if (isset($this->mailData['attachments']) && is_array($this->mailData['attachments']) && count($this->mailData['attachments']) > 0)
            foreach ($this->mailData['attachments'] as $attachment) {
                array_push($attachments, Attachment::fromStorage($attachment['path'])
                    ->as($attachment['name']));
            };
        return $attachments;
    }
}
