<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Mail\SendCampaignEmails;
use App\Models\EmailTemplate;
use App\Models\Campaign;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
        $emailTemplates = EmailTemplate::where('template_type', '!=', 'Campaign')->get();
        return view('email-templates.index', compact('emailTemplates'));
    }

    public function preview(Request $request, $id)
    {
        //
        $contact = Contact::first();
        $template = EmailTemplate::find($id);
        if ($template) {
            $mailData = [
                'from' => ['email' => env('MAIL_FROM_ADDRESS', ''), 'name' => env('MAIL_FROM_NAME', '')],
                'replyTo' => ['email' => 'info@consultile.com', 'name' => 'Consultile'],
                'to' => ['email' => 'test1@emadissa.com', 'name' => 'Emad Isaa'],
                'subject' => 'Send Campaign Emails',
                'tracking' => 1,
                'messageId' => md5($request->send_to . now()->timestamp),
                'body' => Helper::parser($contact->email, $template->content)
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
            'tracking' => 1,
            'messageId' => md5($request->send_to . now()->timestamp),
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
        if (!empty($request->cid))
            $request->request->add(['template_type' => 'Campaign']);
        else
            $request->request->add(['template_type' => 'Default select']);
        $content = $request->content;
        // $dom = new \DomDocument();
        // $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        // $imageFile = $dom->getElementsByTagName('imageFile');

        // foreach ($imageFile as $item => $image) {
        //     $data = $image->getAttribute('src');
        //     if (count(explode(';', $data)) > 1) {
        //         list($type, $data) = explode(';', $data);
        //         list(, $data)      = explode(',', $data);
        //         $imgeData = base64_decode($data);
        //         $image_name = "uploads/images/emails/" . time() . $item . '.png';
        //         // $path = public_path() . $image_name;
        //         // file_put_contents($path, $imgeData);
        //         Storage::put("public/".$image_name, $imgeData);
        //         $image->removeAttribute('src');
        //         $image->setAttribute('src', env('APP_URL')."/storage/".$image_name);
        //     }
        // }

        // $content = $dom->saveHTML();
        $request->merge([ 'content' => $content ]);
        $emailTemplate = EmailTemplate::create($request->all());
        if ($emailTemplate) {
            DB::table('campaigns')->where('id', $request->cid)->update(['template_id' => $emailTemplate->id]);
            if (!empty($request->cid))
                return response("please refresh page");
        }

        return redirect('email/templates/' . $emailTemplate->id . '/edit');
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
            'tracking' => 1,
            'messageId' => md5(env('MAIL_FROM_ADDRESS', '') . now()->timestamp),
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
        if($request->restore){
            EmailTemplate::withTrashed()->where('id', $id)->restore();
            return back();
        }elseif($request->delete){
            EmailTemplate::withTrashed()->where('id', $id)->forceDelete();
            return back();
        }
        $content = $request->content;
        // $dom = new \DomDocument();
        // $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        // $imageFile = $dom->getElementsByTagName('img');

        // foreach ($imageFile as $item => $image) {
        //     $data = $image->getAttribute('src');
        //     if (count(explode(';', $data)) > 1) {
        //         list($type, $data) = explode(';', $data);
        //         list(, $data)      = explode(',', $data);
        //         $imgeData = base64_decode($data);
        //         $image_name = "uploads/images/emails/" . time() . $item . '.png';
        //         // $path = public_path() . $image_name;
        //         // file_put_contents($path, $imgeData);
        //         Storage::put("public/".$image_name, $imgeData);
        //         $image->removeAttribute('src');
        //         $image->setAttribute('src', env('APP_URL')."/storage/".$image_name);
        //     }
        // }

        // $content = $dom->saveHTML();
        $request->merge([ 'content' => $content ]);
        $emailTemp = EmailTemplate::find($id);
        if ($request->cid && $emailTemp->template_type != 'Campaign') {
            $request->request->add(['template_type' => 'Campaign']);

            $emailTemplate = EmailTemplate::create($request->all());
            if ($emailTemplate) {
                DB::table('campaigns')->where('id', $request->cid)->update(['template_id' => $emailTemplate->id]);
            }
        } else {
            $emailTemp->update($request->all());
            $emailTemp->save();
        }
        if ($request->query('t'))
            return redirect('/editor?t=' . $request->query('t') . "&&c=$request->cid");
        return view('email-templates.edit', compact('emailTemp'));
    }
    public function fileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->file->extension();

        $request->file->move(public_path('uploads/campaigns'), $imageName);

        /*
            Write Code Here for
            Store $imageName name in DATABASE from HERE
        */

        return response(env('APP_URL','https://app.consultile.com').'/uploads/campaigns/'.$imageName);
        // if ($_FILES['file']['name']) {
        //     if (!$_FILES['file']['error']) {
        //       $name = md5(rand(100, 200));
        //       $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        //       $filename = $name.
        //       '.'.$ext;
        //       $destination = '/public/assets/img/newsletter/'.$filename; //change this directory
        //       $location = $_FILES["file"]["tmp_name"];
        //       move_uploaded_file($location, $destination);
        //       return response('http://app.localhost:8000/assets/img/newsletter/'.$filename); //change this URL
        //     } else {
        //         return response('Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error']);
        //     }
        //   }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $emailTemplate,$id)
    {
        //
        $emailTemplate::find($id)->delete();
        return back();
    }
}
