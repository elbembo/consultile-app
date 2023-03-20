<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CampaignComplete extends Notification
{
    use Queueable;
    // private $campaign;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($campaign)
    {
        //
        $this->campaign = $campaign;
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
        $prec = $this->campaign->audience_done/$this->campaign->total_audience*100;
        return [
            'event'=>'Campaign completed',
            'title' => $this->campaign->name,
            'body' => 'Successfuly sent '.$prec.'% of target keep your eyes on it to know how its performance',
            'time' => now()->timestamp,
            'icon' => 'fa fa-bullhorn',
            'color'=>'#1777af',
            'image'  => null,
            'action'=> 'campaigns/'.$this->campaign->id
            //
        ];
    }
}
