<?php

namespace App\Handler;

use App\Mail\NewClientRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;


class WebhookJobHandlerForZohoProjects extends ProcessWebhookJob
{

    public function handle()
    {
        //I have access to $this->webhookCall provided in ProcessWebhookJob class
        // logger($this->webhookCall);
        // sleep(15);
        // logger("I am done WebhookJobHandlerForZohoForms");
        // logger($this->webhookCall->payload);
        $users = User::all();
        // logger($users);

        $users = $users->filter(function ($user, $key) {
            return $user->hasAnyRole('admin', 'Super Admin', 'supervisor');
        });
        foreach ($users as $key => $user) {
            logger($user->email);
            Mail::to($user->email)->send(new NewClientRequest($this->webhookCall->payload));
        }
    }
}
