<?php

namespace App\Listeners;

use App\Events\CampaignComplete;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCampaignCompleteNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CampaignComplete  $event
     * @return void
     */
    public function handle(CampaignComplete $event)
    {
        //
    }
}
