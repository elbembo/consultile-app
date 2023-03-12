<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Campaign;
use App\Mail\SendCampaignEmails;
use App\Models\Contact;
use App\Models\EmailQeue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailTemplate;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

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
        $campaigns = Campaign::where('id', '>', '0')->orderBy('id', 'desc')->paginate(10);
        return view('campaign.index', compact('campaigns'));
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
        $settings = Setting::where('key', 'stmp_sender_name')
            ->orWhere('key', 'stmp_replay_email')
            ->orWhere('key', 'stmp_replay_name')->get();
        $headers = array();
        foreach ($settings as $setting) {
            $headers[$setting['key']] = $setting['value'];
        }
        return view('campaign.create', compact('templates', 'headers'));
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
        if ($campaigns)
            return redirect("campaigns/$campaigns->id/edit");
        // return view('mail.view')->with($code);
        // return view('campaign.create',compact('code'));
        //  return view('campaign.create',compact('code'));

    }
    public function send_test(Request $request)
    {
        //
        $contact = DB::table('contacts')->where('id', 1)->first();
        if ($contact)
            $campaign = DB::table('campaigns')->where('id', $request->id)->first();
        if ($campaign)
            $mailTemp = DB::table('email_templates')->where('id', $campaign->template_id)->first();
        if ($mailTemp) {
            $mailData = [
                'from' => ['email' => env('MAIL_FROM_ADDRESS', ''), 'name' => env('MAIL_FROM_NAME', '')],
                'replyTo' => ['email' => $campaign->replay_to, 'name' => $campaign->sender_name],
                'to' => ['email' => $request->send_to, 'name' => $contact->first_name],
                'subject' => $campaign->subject,
                'attachments' => $campaign->details,
                'body' => Helper::parser($contact->email, $mailTemp->content)
            ];
            if (Mail::to($request->send_to)->send(new SendCampaignEmails($mailData))) {
                return response()->json($request->all());
            }
            return response()->json($request->all(),404);
            // if (Mail::to($contact->email, 'Test Email Isaa')->send(new SendCampaignEmails($mailData)));
        }
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
        if ($campaign)
            return view('campaign.create', compact('campaign', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $contacts = Contact::all();
        $campaign = Campaign::find($id);
        if (isset($request->action)) {
            if ($request->action == 'update_status') {
                if ($request->status == 'processing') {
                    $ta = 0;
                    foreach ($contacts as $contact) {
                        EmailQeue::create([
                            'capmaign_id' => $campaign->id,
                            'contact_id' => $contact->id,
                            'priority' => $campaign->campaign_priority,
                            'massage_id' => now()->timestamp,
                        ]);
                        $ta++;
                    }
                    $request->request->add(['total_audience' => $ta]);
                } elseif ($request->status == 'canceled') {
                    DB::table('email_qeues')->where('capmaign_id', $campaign->id)->delete();
                } elseif ($request->status == 'pending') {
                    DB::table('email_qeues')->where('capmaign_id', $campaign->id)->update([
                        'priority' => 0,
                    ]);
                }
            } elseif ($request->action == 'uploads' && $request->hasFile('attachmens')) {

                $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
                $files = $request->file('attachmens');
                // dd($files);
                $attachmens = [];
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $check = true; //in_array($extension, $allowedfileExtension);
                    // dd($file)
                    $path = $file->store('attachmens');

                    if ($check) {
                        $attachmens[] = [
                            'path' => $path,
                            'name' => $filename,
                            'mime' => 'application/' . $extension,

                        ];
                    }
                }
                $request->request->add(['details' => $attachmens]);
            }
        }
        $campaign = Campaign::find($id);
        $campaign->update($request->all());
        $campaign->save();

        return back();
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
