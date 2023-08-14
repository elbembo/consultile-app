<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactTag;

use Illuminate\Http\Request;

class ContactTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('users.index');
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
     * @param  \App\Http\Requests\StoreContactTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Contact $contact)
    {
        //
        $contact->update(["tags" => strtolower($request->tags)]);
        $contact->save();

        return response()->json($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactTag  $contactTag
     * @return \Illuminate\Http\Response
     */
    public function show(ContactTag $contactTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactTag  $contactTag
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactTag $contactTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactTagRequest  $request
     * @param  \App\Models\ContactTag  $contactTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactTag $contactTag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactTag  $contactTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactTag $contactTag)
    {
        //
    }
}
