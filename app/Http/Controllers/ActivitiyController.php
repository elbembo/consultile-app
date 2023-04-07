<?php

namespace App\Http\Controllers;

use App\Models\Activitiy;
use App\Models\DropList;
use App\Models\User;
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
        $users = [];
        $today =   Carbon::now();
        if (request()->get('start') && request()->get('end')) {
            if (request()->get('start') == request()->get('end')) {
                $oneDay = Carbon::createFromFormat('Y-m-d', request()->get('start'));
                $interval = 1;
            } else {
                $startDate = Carbon::createFromFormat('Y-m-d', request()->get('start'));
                $endDate = Carbon::createFromFormat('Y-m-d', request()->get('end'));
                $interval = $startDate->diff($endDate)->format('%a');
            }
        } else {
            $oneDay = Carbon::now();
            $interval = 1;
        }
        // dump(request()->get('start') . ' to ' . request()->get('end'));
        if (Auth()->user()->can('show all activities')) {
            if (!empty($oneDay)) {

                $counts = Activitiy::select('action', DB::raw('count(*) as total'))->whereDay('created_at', $oneDay)->where('type', 1)->groupBy('action')->get();

                $userCounts = Activitiy::select('activitiys.action', 'activitiys.user_id', 'users.name', DB::raw('count(*) as total'))
                    ->join('users', 'users.id', 'activitiys.user_id')
                    ->whereDay('activitiys.created_at', $oneDay)
                    ->where('activitiys.type', 1)
                    ->groupBy('activitiys.action', 'activitiys.user_id')->get();


                $activities = Activitiy::whereDay('created_at', $oneDay)->where('type', 1)->get();

                $grouped = $activities->groupBy('url')->map(function ($row) {
                    return $row->count();
                });
            } elseif (!empty($startDate) && !empty($endDate)) {

                $counts = Activitiy::select('action', DB::raw('count(*) as total'))->whereBetween('created_at', [$startDate, $endDate])->where('type', 1)->groupBy('action')->get();

                $userCounts = Activitiy::select('activitiys.action', 'activitiys.user_id', 'users.name', DB::raw('count(*) as total'))
                    ->join('users', 'users.id', 'activitiys.user_id')
                    ->whereBetween('activitiys.created_at', [$startDate, $endDate])
                    ->where('activitiys.type', 1)
                    ->groupBy('activitiys.action', 'activitiys.user_id')->get();

                $activities = Activitiy::whereBetween('created_at', [$startDate, $endDate])->where('type', 1)->get();

                $grouped = $activities->groupBy('url')->map(function ($row) {
                    return $row->count();
                });
            }
        } else {
            if (!empty($oneDay)) {
                $counts = Activitiy::select('action', DB::raw('count(*) as total'))->whereDay('created_at', $oneDay)->where('type', 1)->where('user_id', auth()->id())->groupBy('action')->get();
                $activities = Activitiy::whereDay('created_at', $oneDay)->where('type', 1)->where('user_id', auth()->id())->get();
                $grouped = $activities->groupBy('url')->map(function ($row) {
                    return $row->count();
                });
            } elseif (!empty($startDate) && !empty($endDate)) {
                $counts = Activitiy::select('action', DB::raw('count(*) as total'))->whereBetween('created_at', [$startDate, $endDate])->where('type', 1)->where('user_id', auth()->id())->groupBy('action')->get();
                $activities = Activitiy::whereBetween('created_at', [$startDate, $endDate])->where('type', 1)->where('user_id', auth()->id())->get();
                $grouped = $activities->groupBy('url')->map(function ($row) {
                    return $row->count();
                });
            }
        }
        $duplicates = 0;
        foreach ($grouped as $key => $value) {
            if ($value > 1)
                $duplicates += ($value - 1);
        }
        $usersTarget = [];
        foreach ($userCounts as  $value) {
            $usersTarget[$value->user_id] = [
                'user_id' => $value->user_id,
                'name' => $value->name,
                'days' => $interval,
            ];
        }
        foreach ($userCounts as  $value) {

            $user = User::find($value->user_id);
            $usersTarget[$value->user_id]['actions'][$value->action] = [
                'total' => $value->total,
                'target_per_month' => !empty($user->emp->target[$value->action]) ? $user->emp->target[$value->action] : 0,
                'target_per_days' => !empty($user->emp->target[$value->action]) ? floor($user->emp->target[$value->action] / 30 * $interval) : 0,
            ];
        }
        // dump($usersTarget);
        return view('activities.index', compact('activities', 'counts', 'duplicates', 'usersTarget'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lastes = Activitiy::where('type', 1)->where('user_id', auth()->id())->orderBy('id', 'desc')->first();
        $accountsList = DropList::where('section', 'linkedin-accounts')->where('show', 1)->get();
        $actionList = DropList::where('section', 'communicate-action')->where('show', 1)->get();
        return view('activities.create', compact('accountsList', 'actionList', 'lastes'));
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
