<?php

namespace App\Http\Controllers;

use App\Models\DropList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $dropLists = DropList::all()->groupBy('section');
        // dd($dropLists);
        return view('settings.drop-list', compact('dropLists'));
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
        $request->merge(['value' => Str::slug($request->name, '-')]);
        DropList::create($request->all());
        return back();
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
        $dropList->update($request->all());
        return response()->json(true);
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
