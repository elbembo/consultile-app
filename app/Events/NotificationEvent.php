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
        require __DIR__ . '/../../vendor/autoload.php';

    $options = array(
        'cluster' => 'mt1',
        'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
        'e26f3579c24775647413',
        'bd4323c99bf947f7003f',
        '1571838',
        $options
    );

    $data['message'] = 'hello world';
    $pusher->trigger('my-channel', 'my-event', $data);
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
