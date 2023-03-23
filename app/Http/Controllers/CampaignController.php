<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Campaign;
use App\Mail\SendCampaignEmails;
use App\Models\Contact;
use App\Models\ContactGroupe;
use App\Models\EmailQeue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailTemplate;
use App\Models\EmailTraker;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\CampaignComplete;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Throwable;

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
        $groups = ContactGroupe::orderBy('group_name')->get()->groupBy(function ($data) {
            return $data->group_name;
        });
        $templates = EmailTemplate::where('template_type', '!=', 'Campaign')->get();
        $settings = Setting::where('key', 'stmp_sender_name')
            ->orWhere('key', 'stmp_replay_email')
            ->orWhere('key', 'stmp_replay_name')->get();
        $headers = array();
        foreach ($settings as $setting) {
            $headers[$setting['key']] = $setting['value'];
        }
        return view('campaign.create', compact('templates', 'headers', 'groups'));
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
        $msgId = md5($request->send_to . now()->timestamp);
        $contact = Contact::first();
        if (!empty($contact))
            $campaign = Campaign::find($request->id);
        if (!empty($campaign))
            $mailTemp = DB::table('email_templates')->where('id', $campaign->template_id)->first();
        if (!empty($mailTemp)) {
            $mailData = [
                'from' => ['email' => env('MAIL_FROM_ADDRESS', ''), 'name' => $campaign->sender_name],
                'replyTo' => ['email' => $campaign->replay_to, 'name' => $campaign->replay_to_name],
                'to' => ['email' => $request->send_to, 'name' => $contact->first_name],
                'subject' => $campaign->subject,
                'attachments' => $campaign->details,
                'tracking' => $campaign->tracking,
                'messageId' => $msgId,
                'body' => Helper::parser($contact->email, $mailTemp->content)
            ];
            if (Mail::to($request->send_to)->send(new SendCampaignEmails($mailData))) {
                return response()->json([...$request->all(), 'messageId' => $msgId]);
            }

            // if (Mail::to($contact->email, 'Test Email Isaa')->send(new SendCampaignEmails($mailData)));
        }
        return response()->json($contact, 404);
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
        $sql = "SELECT sum(delivered) as delivered ,sum(opend) as opend ,sum(views) as views FROM email_trakers WHERE capmaign_id = :ID";
        $tracking = DB::select($sql, ['ID' => $campaign->id]);
        $temp = EmailTemplate::find($campaign->template_id);
        return view('campaign.view', compact('campaign', 'temp', 'tracking'));
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
        $groups = ContactGroupe::orderBy('group_name')->get()->groupBy(function ($data) {
            return $data->group_name;
        });
        $templates = EmailTemplate::where('template_type', '!=', 'Campaign')->get();
        $campaign = Campaign::find($id);
        if ($campaign)
            return view('campaign.create', compact('campaign', 'templates', 'groups'));
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
        if ($request->restore) {
            Campaign::withTrashed()->where('id', $id)->restore();
            return back();
        } elseif ($request->delete) {
            Campaign::withTrashed()->where('id', $id)->forceDelete();
            return redirect('/campaigns');
        }
        $campaign = Campaign::find($id);
        if (isset($request->action)) {
            if ($request->action == 'update_status') {
                if ($request->status == 'processing') {
                    $ta = 0;
                    if ($campaign->group_name != '0') {
                        $contactGroup = ContactGroupe::where('group_name', '=', $campaign->group_name)->pluck('contact_id');
                        $contacts = Contact::whereIn('id', $contactGroup)->where('subscribe', 1)->get();
                    } else {
                        $contacts = Contact::where('subscribe', 1)->get();
                    }
                    foreach ($contacts as $contact) {
                        if (preg_match("/(.+)@(.+)\.(.+)/i", $contact->email)) {
                            EmailQeue::create([
                                'capmaign_id' => $campaign->id,
                                'contact_id' => $contact->id,
                                'priority' => $campaign->campaign_priority,
                                'massage_id' => now()->timestamp,
                            ]);
                            $ta++;
                        }
                    }
                    $tracking =  isset($request->tracking) ? 1 : 0;
                    $request->request->add(['total_audience' => $ta, 'tracking' => $tracking]);
                    $campaign = Campaign::find($id);
                    $campaign->update($request->all());
                    $campaign->save();
                    return redirect("campaigns");
                } elseif ($request->status == 'canceled') {
                    DB::table('email_qeues')->where('capmaign_id', $campaign->id)->delete();
                } elseif ($request->status == 'replicate') {
                    $newCampaign = $campaign->replicate();
                    $newCampaign->created_at = Carbon::now();
                    $newCampaign->total_audience = 0;
                    $newCampaign->audience_done = 0;
                    $newCampaign->status = 'draft';
                    if (strpos($campaign->name, 'Replicate') !== false) {
                        $needle = 'Replicate';
                        $number = substr($campaign->name, strpos($campaign->name, $needle) + strlen($needle));
                        $newReplicate = substr_replace($campaign->name, " " . $number + 1, strlen($needle)  + strpos($campaign->name, $needle));
                        $newCampaign->name = $newReplicate;
                    } else {
                        $newCampaign->name = $campaign->name . ' Replicate 1';
                    }

                    $newCampaign->save();
                    return redirect("campaigns/$newCampaign->id/edit");
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
        $campaign->delete();
        return redirect('/campaigns');

    }
    public function removeAttachment(Request $request)
    {
        //
        $campaign = Campaign::find($request->id);
        if ($campaign) {
            $attachments = $campaign->details;
            unset($attachments[$request->index]);
            $campaign->details = $attachments;
            $campaign->save();
            return response()->json(true, 200);
        }
        return response()->json($campaign, 404);
    }
    public static function qeueHandle($campaign, $contact, $qeue, $sent)
    {
        if (EmailTraker::create([
            'capmaign_id' => $campaign->id,
            'contact_id' => $contact->id,
            'priority' => $campaign->campaign_priority,
            'massage_id' => $qeue->massage_id,
            'delivered' => $sent ? null : 0
        ])) {
            DB::table('email_qeues')->where('id', $qeue->id)->delete();
            $campaign->audience_done = $campaign->audience_done + 1;
            $campaign->status =  $campaign->audience_done  >= $campaign->total_audience ? 'completed' :  $campaign->status;
            $campaign->save();
            if ($campaign->status == 'completed') {
                $users = User::all();
                Notification::send($users, new CampaignComplete($campaign));
            }
        }
    }
    public static function send()
    {
        $check = EmailQeue::where('priority', '>', 0)->first();
        if (!empty($check)) {
            $sec = env('SCHEDULED_SEC', 5);
            for ($i = 0; $i < $sec; $i++) {
                $qeue = EmailQeue::where('priority', '>', 0)->first();
                if (!empty($qeue)) {
                    $contact = DB::table('contacts')->where('id', $qeue->contact_id)->first();
                    if ($contact) {
                        $campaign = Campaign::find($qeue->capmaign_id);
                    }
                    if ($campaign) {
                        $mailTemp = DB::table('email_templates')->where('id', $campaign->template_id)->first();
                    }
                    if ($mailTemp) {
                        $emailto = trim(trim($contact->email,"‎"));
                        $mailData = [
                            'from' => ['email' => env('MAIL_FROM_ADDRESS', 'newsletters@consultile-mea.com'), 'name' => $campaign->sender_name],
                            'replyTo' => ['email' => $campaign->replay_to, 'name' => $campaign->replay_to_name],
                            'to' => ['email' =>$emailto, 'name' => $contact->first_name],
                            'subject' => $campaign->subject,
                            'attachments' => $campaign->details,
                            'tracking' => $campaign->tracking,
                            'messageId' => $qeue->massage_id,
                            'body' => Helper::parser($emailto, $mailTemp->content, $qeue->massage_id)
                        ];
                        if (preg_match("/(.+)@(.+)\.(.+)/i", $emailto)) {
                            try {
                                if (Mail::to($emailto)->send(new SendCampaignEmails($mailData))) {
                                    self::qeueHandle($campaign, $contact, $qeue, true);
                                } else {
                                    self::qeueHandle($campaign, $contact, $qeue, false);
                                }
                            } catch (Throwable $exception) {
                                Log::error($exception);
                                self::qeueHandle($campaign, $contact, $qeue, false);
                            }
                        } else {
                            self::qeueHandle($campaign, $contact, $qeue, false);
                        }
                        // if (Mail::to($contact->email, 'Test Email Isaa')->send(new SendCampaignEmails($mailData)));
                    }
                }
            }
        }
    }
}
