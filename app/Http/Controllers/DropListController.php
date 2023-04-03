<?php

namespace App\Http\Controllers;

use App\Models\DropList;
use Illuminate\Http\Request;

class DropListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('settings.drop-list');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DropList  $dropList
     * @return \Illuminate\Http\Response
     */
    public function show(DropList $dropList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DropList  $dropList
     * @return \Illuminate\Http\Response
     */
    public function edit(DropList $dropList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DropList  $dropList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DropList $dropList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DropList  $dropList
     * @return \Illuminate\Http\Response
     */
    public function destroy(DropList $dropList)
    {
        //
    }
}
