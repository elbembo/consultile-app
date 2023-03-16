<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;
use Webklex\IMAP\Commands\ImapIdleCommand;
use Webklex\PHPIMAP\Message;
class ReceiveEmails extends ImapIdleCommand 
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'IMAP email get Command description';
    protected $account = "default";
    /**
     * Execute the console command.
     *
     * @return int
     */
    // public function handle()
    // {
    //     return Command::SUCCESS;
    // }
    public function onNewMessage(Message $message){
        Log::info("New message received: ".$message->subject);
    }
}
