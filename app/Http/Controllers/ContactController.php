<?php

namespace App\Http\Controllers;

use App\Exports\ExampleExport;
use App\Imports\ContatcImport;
use App\Imports\ContatcImportCheck;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $contacts = Contact::where('id', '>', '0')->orderBy('id', 'desc')->paginate(30);
        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contact.create');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
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

        $contact = Contact::find($id);
        $contact->update($request->all());
        $contact->save();
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
    }
    public function import(Request $request)
    {

        if ($request->method() == "POST") {
            $validated = $request->validate([
                'contacts' => 'max:2000|mimes:xlsx,xlsm,xltx,tsv,csv,xml,xlt,xls,xltm,xltx,xlsm'
            ]);
            if (!$validated)
                return back();
            $file = $request->file('contacts');
            $failures = [];
            try {
                $import = new ContatcImport();
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
}
