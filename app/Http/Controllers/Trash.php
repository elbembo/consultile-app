<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Contact;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class Trash extends Controller
{
    //
    public function index()
    {
        $emailTemplates = EmailTemplate::onlyTrashed()->paginate(15);
        $contacts = Contact::onlyTrashed()->paginate(15);
        $contacts = Campaign::onlyTrashed()->paginate(15);
        return view('trash.index',compact('emailTemplates','contacts','contacts'));
    }
}
