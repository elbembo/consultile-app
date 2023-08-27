<?php

namespace App\Handler;

use Spatie\WebhookClient\Jobs\ProcessWebhookJob;


class WebhookJobHandlerForZohoForms extends ProcessWebhookJob
{

    public function handle()
    {
        //I have access to $this->webhookCall provided in ProcessWebhookJob class
        // logger($this->webhookCall);
        // sleep(15);
        // logger("I am done");
    }
}
