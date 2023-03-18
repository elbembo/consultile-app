<?php

namespace App\Http\Controllers;

use App\Models\CampaignReport;
use Illuminate\Http\Request;
use Webklex\IMAP\Facades\Client;
class CampaignReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $folders = $client->getFolders();
        
        
        return view('reports.campaigns.index',compact('folders'));
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
