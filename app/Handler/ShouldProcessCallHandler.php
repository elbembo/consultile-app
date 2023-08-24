<?php
namespace App\Handler;

use Illuminate\Http\Request;

use Spatie\WebhookClient\WebhookProfile\WebhookProfile;

class ShouldProcessCallHandler implements WebhookProfile
{
    /**
     * @param Request $request
     * @return bool
     */
    public function shouldProcess(Request $request): bool
    {
        // you can filter out request you want to save into the DB here
        if ($request->has('user')) {
            return true;
        }

        return false;
    }
}
