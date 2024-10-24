<?php

namespace App\Http\Controllers;

use App\Exports\ContactsExport;
use App\Exports\ExampleExport;
use App\Helpers\VerifyEmail;
use App\Imports\ContatcImport;
use App\Imports\ContatcImportCheck;
use App\Models\Contact;
use App\Models\EmailTraker;
use App\Models\Unsubscribe;
use App\Models\User;
use App\Notifications\ContactUnsubscribe;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::where('contacts.id', '>', '0')->orderBy('contacts.id', 'desc')->paginate(30);
        // dd($contacts);
        $count  = $contacts->total();

        $countWithEmail  =  Contact::where('email', '!=', '')->count();
        $views = [];
        foreach($contacts as $contact){

            $views[$contact->id] = EmailTraker::where('contact_id',$contact->id)->sum('email_trakers.views');

        }

        return view('contact.index', compact('contacts','views','count','countWithEmail'));
    }
    public function companies()
    {
        # code...
        $list = [];
        $companies = Contact::withTrashed()->get()->groupBy('company')->toArray();
        foreach ($companies as $company => $data) {
            array_push($list, $company);
        }
        return response()->json($list);
    }
    public function countries()
    {
        # code...
        $list = [];
        $countries = Contact::withTrashed()->get()->groupBy('country')->toArray();
        foreach ($countries as $country => $data) {
            array_push($list, $country);
        }
        return response()->json($list);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $companies = Contact::withTrashed()->get()->groupBy('company');
        // dd($companies);
        return view('contact.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {

        //
        $contact = Contact::create($request->all());
        if ($contact)
            return redirect("contacts/create");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
        $tracker = EmailTraker::where('email_trakers.contact_id', $contact->id)->join('campaigns', 'email_trakers.capmaign_id', '=', 'campaigns.id')->orderBy('email_trakers.id','desc')->take(5)->get()
            ->toArray();
        $feedback = Unsubscribe::where('contact_id', $contact->id)->get()->groupBy('reason')->toArray();
        // dd($feedback);
        $notes = $contact->notes;
        return view('contact.view', compact('contact', 'tracker', 'feedback','notes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $companies = Contact::withTrashed()->get()->groupBy('company');
        return view('contact.create', compact('contact', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        if ($request->restore) {
            Contact::withTrashed()->where('id', $id)->restore();
            return back();
        } elseif ($request->delete) {
            Contact::withTrashed()->where('id', $id)->forceDelete();
            return back();
        }
        if (empty($request->email))
            $request->request->remove('email');
        if (empty($request->personal_phone))
            $request->request->remove('personal_phone');
        if (empty($request->work_phone))
            $request->request->remove('work_phone');

        $contact = Contact::find($id);
        $contact->update($request->all());
        $contact->save();
        if ($request->header('Content-Type') == 'application/json')
            return response()->json(true);
        return back();
        return redirect("contacts/$contact->id/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
        $contact->delete();
        return back();
    }
    public function import(Request $request)
    {

        if ($request->method() == "POST") {
            $validated = $request->validate([
                'contacts' => 'max:3000|mimes:xlsx,xlsm,xltx,tsv,csv,xml,xlt,xls,xltm,xltx,xlsm'
            ]);
            if (!$validated)
                return back();
            $file = $request->file('contacts');
            $failures = [];
            try {
                $import = new ContatcImport($request->group_name);
                $import->import($file);
                $failures = $import->failures();
                if ($request->debug != 'debug')
                    $failures = null;
                return view('contact.import', compact('failures'));
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();

                return view('contact.import', compact('failures'));
            }
        }
        return view('contact.import');
    }
    public function exportExample()
    {
        return new ExampleExport();
    }
    public function export()
    {
        // return new ContactsExport();
        return Excel::download(new ContactsExport, 'All_Contacts.app.consultile.com.xlsx');
    }
    public function emailValidation(Request $request)
    {
        if (isset($request->id) && !empty($request->id)) {
            $contact = Contact::find($request->id);
            $email  = $contact->email;
            if (preg_match('/\b[\w\.-]+@[\w\.-]+\.\w{2,6}\b/', $email)) {
                $mail = new VerifyEmail();

                // Set the timeout value on stream
                $mail->setStreamTimeoutWait(20);

                // Set debug output mode
                $mail->Debug = true;
                $mail->Debugoutput = 'log';

                // Set email address for SMTP request
                $mail->setEmailFrom(env('MAIL_FROM_ADDRESS'));

                // Email to check
                // $email = 'email@example.com';

                // Check if email is valid and exist
                if ($mail->check($email)) {
                    return response()->json(true);
                } elseif (verifyEmail::validate($email)) {
                    return response()->json(false);
                } else {
                    return response()->json('err');
                }
            }
            return response()->json('not email');
        }
        return response()->json($request->id);
    }
    public function isDuplicate(Request $request)
    {
        $contact = Contact::where($request->name, $request->value)->first();
        return response()->json($contact);
    }
    public function search(Request $request)
    {
        $trim = explode(" ", $request->trim);
        $firstName = $trim[0];
        $lastName = isset($trim[1]) ?  $trim[1] : $trim[0];
        $contacts = Contact::where('email', 'like', "%$request->trim%")
            ->orWhere('work_phone', 'like', "%$request->trim%")
            ->orWhere('personal_phone', 'like', "%$request->trim%")
            ->orWhere('company', 'like', "%$request->trim%")
            ->orWhere('first_name', 'like', "%$firstName%")
            ->orWhere('last_name', 'like', "%$lastName%")
            ->groupBy('id')
            ->orderBy('id', 'desc')->get();
        $views = [];
        foreach($contacts as $contact){

            $views[$contact->id] = EmailTraker::where('contact_id',$contact->id)->sum('email_trakers.views');

        }
        return view('components.contacts-list', compact('contacts','views'));
    }
    public function unsubscribe(Request $request)
    {
        $t = $request->input('t');
        if ($request->method() == "POST") {
            $tracker = EmailTraker::where('massage_id', $t)->first();
            if (!empty($tracker) && $tracker->type == 'email_campaign') {
                $contact = Contact::find($tracker->contact_id);
                if (!empty($request->reason))
                    foreach ($request->reason as $reason) {
                        Unsubscribe::create([
                            'contact_id' => $tracker->contact_id,
                            'massage_id' => $t,
                            'reason' => $reason
                        ]);
                    }
                if (!empty($contact)) {
                    if ($request->type == 'unsubscribe') {
                        $contact->subscribe = 0;
                        $contact->save();
                    }
                    $users = User::all();
                    Notification::send($users, new ContactUnsubscribe($contact, $request->type));
                }
            }
            return view('unsubscribe');
        }
        return view('unsubscribe', compact('t'));
    }
}
