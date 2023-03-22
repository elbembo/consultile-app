<?php

namespace App\Console\Commands;

use App\Events\CampaignComplete;
use App\Helpers\Helper;
use App\Http\Controllers\CampaignController;
use App\Mail\SendCampaignEmails;
use App\Models\Campaign;
use App\Models\EmailQeue;
use App\Models\EmailTraker;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mockery\Expectation;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a qeued email to the user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        CampaignController::send();


        return Command::SUCCESS;
    }
}
