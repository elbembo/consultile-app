<?php

namespace App\Console\Commands;

use App\Events\NotificationEvent;
use App\Models\Contact;
use Illuminate\Console\Command;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:noti';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // event(new NotificationEvent('dddddddddddddd'));
        $contacts = Contact::all();
        foreach ($contacts as $contact) {
            file_put_contents(__DIR__ . "/data.txt", $contact->email . PHP_EOL, FILE_APPEND);
        }
        return Command::SUCCESS;
    }
}
