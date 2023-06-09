<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\EmailTemplate;
use App\Models\Summernote;
use Illuminate\Http\Request;

class SummernoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cid = $request->query('c');
        $tid = $request->query('t');
        //
        if ($cid) {
            $campaign = Campaign::find($cid);
            $et = EmailTemplate::where('id',$campaign->template_id)->first();
            return view('components.editor',compact('campaign','et'));
        }
        if ($tid) {
            $et = EmailTemplate::find($tid);
            return view('components.editor',compact('et'));
        }

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
     * @param  \App\Models\Summernote  $summernote
     * @return \Illuminate\Http\Response
     */
    public function show(Summernote $summernote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Summernote  $summernote
     * @return \Illuminate\Http\Response
     */
    public function edit(Summernote $summernote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Summernote  $summernote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Summernote $summernote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Summernote  $summernote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Summernote $summernote)
    {
        //
    }
}
