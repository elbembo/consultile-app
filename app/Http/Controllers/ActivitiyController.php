<?php

namespace App\Http\Controllers;

use App\Models\Activitiy;
use App\Models\DropList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivitiyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today =   Carbon::now();
        if (Auth()->user()->hasRole(['admin'])|| Auth()->user()->hasDirectPermission('show all activities')) {
            $counts = Activitiy::select('action', DB::raw('count(*) as total'))->whereDay('created_at', $today)->where('type', 1)->groupBy('action')->get();
            $activities = Activitiy::whereDay('created_at', $today)->where('type', 1)->get();
        } else {
            $counts = Activitiy::select('action', DB::raw('count(*) as total'))->whereDay('created_at', $today)->where('type', 1)->where('user_id',auth()->id())->groupBy('action')->get();
            $activities = Activitiy::whereDay('created_at', $today)->where('type', 1)->where('user_id',auth()->id())->get();
        }

        return view('activities.index', compact('activities', 'counts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $accountsList = DropList::where('section', 'linkedin-accounts')->where('show', 1)->get();
        $actionList = DropList::where('section', 'communicate-action')->where('show', 1)->get();
        return view('activities.create', compact('accountsList', 'actionList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Activitiy::create(array_merge($request->all(), ['user_id' => 5]));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activitiy  $activitiy
     * @return \Illuminate\Http\Response
     */
    public function show(Activitiy $activitiy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activitiy  $activitiy
     * @return \Illuminate\Http\Response
     */
    public function edit(Activitiy $activitiy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activitiy  $activitiy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activitiy $activitiy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activitiy  $activitiy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activitiy $activitiy)
    {
        //
    }
}
