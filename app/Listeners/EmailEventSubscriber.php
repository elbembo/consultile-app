<?php
 
namespace App\Listeners;
use Webklex\PHPIMAP\Message;
class EmailEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleNewEmail(Message $message) {
        $this->info("New message received: ".$message->subject);
    }
 
    /**
     * Handle user logout events.
     */

 
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Listeners\EmailEventSubscriber@handleNewEmail'
        );
 

    }
}