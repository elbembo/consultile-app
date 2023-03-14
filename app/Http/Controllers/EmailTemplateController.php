<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Mail\SendCampaignEmails;
use App\Models\EmailTemplate;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $emailTemplates = EmailTemplate::all();
        return view('email-templates.index', compact('emailTemplates'));
    }

    public function preview(Request $request,$id)
    {
        //
        $template = EmailTemplate::find($id);
        if ($template) {
            $mailData = [
                'from' => ['email' => env('MAIL_FROM_ADDRESS', ''), 'name' => env('MAIL_FROM_NAME', '')],
                'replyTo' => ['email' => 'info@consultile.com', 'name' => 'Consultile'],
                'to' => ['email' => 'test1@emadissa.com', 'name' => 'Emad Isaa'],
                'subject' => 'Send Campaign Emails',
                'body' => Helper::parser('cto@emadissa.com', $template->content)
            ];
            // if(Mail::to('test1@emadissa.com','Test user')->send(new SendCampaignEmails($mailData)));
            // $email = Mail::failures();
            // return view('campaign.index')->with($email);
            return (new SendCampaignEmails($mailData))->render();
        }
        return response()->json($request->all());
    }
    public function send_test(Request $request)
    {
        //
        $data = $request->all();
        //return response()->json($request->template_id);
        $emailTemplates = EmailTemplate::find($request->template_id);
        $mailData = [
            'from' => ['email' => env('MAIL_FROM_ADDRESS', ''), 'name' => env('MAIL_FROM_NAME', '')],
            'replyTo' => ['email' => $request->replay_to, 'name' => $request->sender_name],
            'to' => ['email' => $request->send_to, 'name' => 'Emad Isaa'],
            'subject' => $request->subject,
            'attachments' => $request->details,
            'body' => Helper::parser($request->send_to, $emailTemplates->content)
        ];
        if (Mail::to($request->send_to)->send(new SendCampaignEmails($mailData)))
            return response()->json($request->all());
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
        return view('email-templates.create');
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

        $emailTemplate = EmailTemplate::create($request->all());
        if ($emailTemplate) {
            // $campaign = Campaign::find($request->cid);
            // $campaign->template_id = $emailTemplate->id;
            // $campaign->save();
            DB::table('campaigns')->where('id', $request->cid)->update(['template_id' => $emailTemplate->id]);
            $mailData = [
                'from' => ['email' => env('MAIL_FROM_ADDRESS', ''), 'name' => env('MAIL_FROM_NAME', '')],
                'replyTo' => ['email' => 'info@consultile.com', 'name' => 'Consultile'],
                'to' => ['email' => 'test1@emadissa.com', 'name' => 'Emad Isaa'],
                'subject' => 'Send Campaign Emails',
                'body' => Helper::parser('cto@emadissa.com', $emailTemplate->content)
            ];
            return response("please refresh page");
        }
        // return view('mail.view')->with($code);
        // return view('campaign.create',compact('code'));
        //  return view('email-templates.edit',compact('code'));
        // return view()
        return redirect('email/templates/' . $emailTemplate->id . '/edit');
        // return response($request->query('c'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplate $emailTemplate, $id)
    {
        //

        $emailTemplate = EmailTemplate::find($id);
        $mailData = [
            'from' => ['email' => env('MAIL_FROM_ADDRESS', ''), 'name' => env('MAIL_FROM_NAME', '')],
            'replyTo' => ['email' => 'info@consultile.com', 'name' => 'Consultile'],
            'to' => ['email' => 'test1@emadissa.com', 'name' => 'Emad Isaa'],
            'subject' => 'Send Campaign Emails',
            'attachments' => null,
            'body' => Helper::parser('cto@emadissa.com', $emailTemplate->content)
        ];
        // if(Mail::to('test1@emadissa.com','Test user')->send(new SendCampaignEmails($mailData)));
        // $email = Mail::failures();
        // return view('campaign.index')->with($email);
        return (new SendCampaignEmails($mailData))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $emailTemp = EmailTemplate::find($id);
        return view('email-templates.edit', compact('emailTemp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $emailTemp = EmailTemplate::find($id);
        $emailTemp->update($request->all());
        $emailTemp->save();
        if ($request->query('t'))
            return redirect('/editor?t=' . $request->query('t')."&&c=$request->cid");
        return view('email-templates.edit', compact('emailTemp'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        //
    }
}
