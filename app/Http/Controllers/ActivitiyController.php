<?php

namespace App\Http\Controllers;

use App\Models\Activitiy;
use App\Models\ActivityDays;
use App\Models\DropList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

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
            $start = request()->get('start')." 00:00:00";
            $end = request()->get('end')." 23:59:59";
            if (request()->get('start') == request()->get('end')) {
                $startDate =  $start;
                $endDate = $end;
                $oneDay = Carbon::createFromFormat('Y-m-d  H:i:s', $start);
                $interval = 1;
            } else {
                $startDate = Carbon::createFromFormat('Y-m-d  H:i:s', $start);
                $endDate = Carbon::createFromFormat('Y-m-d  H:i:s', $end);
                $interval = $startDate->diff($endDate)->format('%a');
            }
        } else {
            $startDate = Carbon::now()->format('Y-m-d  00:00:00');
            $endDate = Carbon::now()->format('Y-m-d 23:59:59');

            $oneDay = Carbon::now();
            $interval = 1;
        }

        $accountsList = [];
        $actionList = [];
        $messageList = [];
        $empList = [];

        if (Auth()->user()->can('show all activities')) {
            $empList = User::role(['employer', 'supervisor'])->get();
            $accountsList = DropList::where('section', 'linkedin-accounts')->where('show', 1)->get();
            $actionList = DropList::where('section', 'communicate-action')->where('show', 1)->get();
            $messageList = DropList::where('section', 'message-subject')->where('show', 1)->get();

            $counts = Activitiy::select('action', DB::raw('count(*) as total'));
            if (!empty(request()->users))
                $counts = $counts->whereIn('user_id', request()->users);
            if (!empty(request()->accounts))
                $counts = $counts->whereIn('account', request()->accounts);
            if (!empty(request()->actions))
                $counts = $counts->whereIn('action', request()->actions);
            if (!empty(request()->messages))
                $counts = $counts->whereIn('message', request()->messages);
            if (!empty($oneDay))
                $counts = $counts->whereBetween('created_at', [$startDate, $endDate])->where('type', 1)->groupBy('action')->get();
            else if (!empty($startDate) && !empty($endDate))
                $counts = $counts->whereBetween('created_at', [$startDate, $endDate])->where('type', 1)->groupBy('action')->get();



            $userCounts = Activitiy::select('activitiys.action', 'activitiys.user_id', 'users.name', DB::raw('count(*) as total'))
                ->join('users', 'users.id', 'activitiys.user_id');
            if (!empty(request()->users))
                $userCounts = $userCounts->whereIn('user_id', request()->users);
            if (!empty(request()->accounts))
                $userCounts = $userCounts->whereIn('account', request()->accounts);
            if (!empty(request()->actions))
                $userCounts = $userCounts->whereIn('action', request()->actions);
            if (!empty(request()->messages))
                $userCounts = $userCounts->whereIn('message', request()->messages);
            if (!empty($oneDay))
                $userCounts = $userCounts->whereBetween('activitiys.created_at',  [$startDate, $endDate])
                    ->where('activitiys.type', 1)->groupBy('activitiys.action', 'activitiys.user_id')->get();
            else if (!empty($startDate) && !empty($endDate))
                $userCounts = $userCounts->whereBetween('activitiys.created_at', [$startDate, $endDate])
                    ->where('activitiys.type', 1)->groupBy('activitiys.action', 'activitiys.user_id')->get();


            $activities = Activitiy::select('*');
            if (!empty(request()->users))
                $activities = $activities->whereIn('user_id', request()->users);
            if (!empty(request()->accounts))
                $activities = $activities->whereIn('account', request()->accounts);
            if (!empty(request()->actions))
                $activities = $activities->whereIn('action', request()->actions);
            if (!empty(request()->messages))
                $activities = $activities->whereIn('message', request()->messages);
            if (!empty($oneDay))
                $activities = $activities->whereBetween('created_at', [$startDate, $endDate])->where('type', 1)->get();
            else if (!empty($startDate) && !empty($endDate))
                $activities = $activities->whereBetween('created_at', [$startDate, $endDate])->where('type', 1)->get();


            $grouped = $activities->groupBy('url')->map(function ($row) {
                return $row->count();
            });
        } else {
            if (!empty($oneDay)) {
                $counts = Activitiy::select('action', DB::raw('count(*) as total'))->whereBetween('created_at', [$startDate, $endDate])->where('type', 1)->where('user_id', auth()->id())->groupBy('action')->get();
                $activities = Activitiy::whereBetween('created_at', [$startDate, $endDate])->where('type', 1)->where('user_id', auth()->id())->get();
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
        if (!empty($userCounts)) {
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
        }
        // dump($startDate." to ".$endDate);
        // dump($usersTarget);
        return view('activities.index', compact('activities', 'counts', 'duplicates', 'usersTarget', 'accountsList', 'actionList', 'messageList', 'empList', 'today','startDate','endDate'));
    }
    function days()
    {
        // $workDays = Activitiy::pluck('created_at')->groupBy(function ($date) {
        //     return Carbon::parse($date)->format('Y-m-d');
        // });
        // foreach ($workDays as $key => $value) {
        //     $days[] = $key;
        // }
        // // dd($days);
        $duplicates = Activitiy::where('user_id', auth()->id())->groupBy('url')->get();

        dd($duplicates);
        return view('activities.duplicates');
    }
    function duplicates()
    {
        $duplicateActivities = Activitiy::select('url')->groupBy('url')->orderBy('url','desc')->paginate(10);
        // dd($duplicates->toArray()['data']);
        $duplicates = Activitiy::whereIn('url', $duplicateActivities->toArray()['data'])->orderBy('url')->get();
        dump($duplicates);
        return view('activities.duplicates',compact('duplicates','duplicateActivities'));
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
        $lastesDays = ActivityDays::where('user_id', auth()->id())->orderBy('id', 'desc')->first();
        // if()
        $accountsList = DropList::where('section', 'linkedin-accounts')->where('show', 1)->get();
        $actionList = DropList::where('section', 'communicate-action')->where('show', 1)->get();
        $messageList = DropList::where('section', 'message-subject')->where('show', 1)->latest()->get();
        return view('activities.create', compact('accountsList', 'actionList', 'lastes', 'messageList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Activitiy::create(array_merge($request->all(), ['user_id' => auth()->id(),"url"=> rtrim(strtok($request->url, '?'), '/')]));
        return redirect('/activities/create');
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
