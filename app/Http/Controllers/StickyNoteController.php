<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\StickyNote;
use Illuminate\Http\Request;

class StickyNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Contact $contact, Request $request)
    {
        //
        $request->request->add(['user_id' => auth()->user()->id]);
        $contact->notes()->create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StickyNote  $stickyNote
     * @return \Illuminate\Http\Response
     */
    public function show(StickyNote $stickyNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StickyNote  $stickyNote
     * @return \Illuminate\Http\Response
     */
    public function edit(StickyNote $stickyNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StickyNote  $stickyNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StickyNote $stickyNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StickyNote  $stickyNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(StickyNote $stickyNote)
    {
        //
    }
}
