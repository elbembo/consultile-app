<?php

namespace App\Http\Controllers;

use App\Models\CampaignReport;
use App\Models\Contact;
use App\Models\EmailTraker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webklex\IMAP\Facades\Client;

class CampaignReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        set_time_limit(0);
        $client = Client::account('default');
        $client->connect();
        // // $folders = $client->getFolders($hierarchical = true);
        // // $info = $client->checkFolder($folder = 'INBOX');
        // $folder = $client->getFolderByName('INBOX');
        // $query = $folder->messages();
        // //dd($query->all()->get());
        // // $messages = $query->all()->get();
        // $message = $query->getMessageByUid($uid = 4);
        // $header = $message->getHeader();
        // dd($message->get("references"));
        // $message->parseBody();
        // $body = $message->getBodies();
        // dd($body);
        $fails = [];
        $reads = [];
        $folders = $client->getFolders();
        foreach ($folders as $folder) {
            $query = $folder->search();
            // $reads = $query->text('Read:')->get();
            // foreach ($messages as $message) {
            //     $parts = explode('@', $message->references);
            //     $msgid = $parts[0];
            //     DB::table('contacts')
            //         ->where('massage_id', str_replace("<", "", $msgid))
            //         ->update(['delivered' => 1, 'opend' => 1, 'views' => 1,]);
            // }
            $messages = $query->text($request->input('msg'))->get();

            foreach ($messages as $message) {

                $parts = explode('@', $message->references);
                $msgid = $parts[0];
                $fails[] = str_replace("<", "", $msgid);
                if (strlen(str_replace("<", "", $msgid)) > 15)
                    $message->delete($expunge = true);
            }
        }
        $contscts = EmailTraker::whereIn('email_trakers.massage_id', $fails)->join('contacts', 'email_trakers.contact_id', '=', 'contacts.id')->get('email');
        file_put_contents('fails_emails.txt', "");
        foreach ($contscts as $contsct) {
            file_put_contents('fails_emails.txt', $contsct->email . "\n", FILE_APPEND);

            DB::table('contacts')
                ->where('email', $contsct->email)
                ->update(['email' => ""]);
        }

        return view('reports.campaigns.index', compact('contscts', 'messages', 'reads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CampaignReport  $campaignReport
     * @return \Illuminate\Http\Response
     */
    public function show(CampaignReport $campaignReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CampaignReport  $campaignReport
     * @return \Illuminate\Http\Response
     */
    public function edit(CampaignReport $campaignReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CampaignReport  $campaignReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CampaignReport $campaignReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CampaignReport  $campaignReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(CampaignReport $campaignReport)
    {
        //
    }
}
