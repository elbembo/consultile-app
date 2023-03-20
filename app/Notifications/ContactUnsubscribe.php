<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactUnsubscribe extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contact, $type)
    {
        //
        $this->contact = $contact;
        $this->type = $type;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'event' => $this->type,
            'title' => $this->contact->first_name . ' ' . $this->contact->last_name,
            'body' => 'One of the newslleters member give a feedback or he is just unsubscribe',
            'time' => now()->timestamp,
            'icon' => $this->type == 'unsubscribe' ? 'fa fa-ban' : 'fa fa-exclamation-triangle',
            'color' => $this->type == 'unsubscribe' ? '#ed2020' : '#edd420',
            'image'  => null,
            'action' => 'contacts/' . $this->contact->id
            //
        ];
    }
}
