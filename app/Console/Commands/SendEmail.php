<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Mail\SendCampaignEmails;
use App\Models\EmailQeue;
use App\Models\EmailTraker;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $sec = env('SCHEDULED_SEC', 15);
        for ($i = 0; $i < (60 / $sec); $i++) {
            $qeue = EmailQeue::where('priority', '>', 0)->first();
            if ($qeue) {
                $contact = DB::table('contacts')->where('id',  $qeue->contact_id)->first();
                if ($contact)
                    $campaign = DB::table('campaigns')->where('id', $qeue->capmaign_id)->first();
                if ($campaign)
                    $mailTemp = DB::table('email_templates')->where('id', $campaign->template_id)->first();
                if ($mailTemp) {
                    $mailData = [
                        'from' => ['email' => env('MAIL_FROM_ADDRESS', ''), 'name' => env('MAIL_FROM_NAME', '')],
                        'replyTo' => ['email' => $campaign->replay_to, 'name' => $campaign->sender_name],
                        'to' => ['email' => $contact->email, 'name' => $contact->first_name],
                        'subject' => $campaign->subject,
                        'attachments' => $campaign->details,
                        'body' => Helper::parser($contact->email, $mailTemp->content, $qeue->massage_id)
                    ];
                    if (Mail::to($contact->email)->send(new SendCampaignEmails($mailData))) {

                        if (EmailTraker::create([
                            'capmaign_id' => $campaign->id,
                            'contact_id' => $contact->id,
                            'priority' => $campaign->campaign_priority,
                            'massage_id' => $qeue->massage_id,
                        ]))
                            DB::table('email_qeues')->where('id', $qeue->id)->delete();
                    }else{
                        $qeue->priority = 10;
                        $qeue->save();

                    }
                    // if (Mail::to($contact->email, 'Test Email Isaa')->send(new SendCampaignEmails($mailData)));
                }
            }
            sleep($sec);
        }

        return Command::SUCCESS;
    }
}
