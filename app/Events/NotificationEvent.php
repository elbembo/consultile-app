<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public function __construct($message)
    {
        $this->message = $message;

    }

    public function broadcastOn()
    {

        //it is a broadcasting channel you need to add this route in channels.php file
        return ['my-channel'];
    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}
