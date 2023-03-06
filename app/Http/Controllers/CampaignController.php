<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Mail\SendCampaignEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailTemplate;
use App\Models\Setting;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('campaign.index');

    }
    public function view()
    {
        //
        $mailData = [
            'from'=>['email'=>'consultile@emadissa.com', 'name'=>'Consultile'],
            'replyTo'=>['email'=>'info@consultile.com', 'name'=>'Consultile'],
            'to'=>['email'=>'test1@emadissa.com', 'name'=>'Emad Isaa'],
            'subject'=>'Send Campaign Emails',
            'body'=>'hiiiiiiiiiii'
        ];
        // if(Mail::to('test1@emadissa.com','Test user')->send(new SendCampaignEmails($mailData)));
        // $email = Mail::failures();
        // return view('campaign.index')->with($email);
        return (new SendCampaignEmails($mailData))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $templates = EmailTemplate::all();
        $settings = Setting::where('key','stmp_sender_name')
        ->orWhere('key','stmp_replay_email')
        ->orWhere('key','stmp_replay_name')->get();
        $headers = array();
        foreach($settings as $setting ){
            $headers[$setting['key']] = $setting['value'];
        }
        return view('campaign.create',compact('templates','headers'));
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
        // $code = $request->content;
        // $attributes = request()->validate([
        //     'name' => ['required', 'max:50'],
        //     'email' => ['required', 'email', 'max:50'],
        //     'phone'     => ['max:50'],
        //     'location' => ['max:70'],
        //     'about_me'    => ['max:150'],
        // ]);
        $campaigns = Campaign::create($request->all());
        if($campaigns)
            return redirect("campaigns/$campaigns->id/edit");
        // return view('mail.view')->with($code);
        // return view('campaign.create',compact('code'));
        //  return view('campaign.create',compact('code'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $templates = EmailTemplate::all();
        $campaign = Campaign::find($id);
        if($campaign )
        return view('campaign.create',compact('campaign','templates'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        //

        return redirect("campaigns/$campaign->id/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
