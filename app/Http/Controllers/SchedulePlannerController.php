<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchedulePlannerRequest;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;

class SchedulePlannerController extends Controller
{
    public function index($year){

        $schedule_list = Schedule::all();
        $users = User::all();

        $weeks = get_year_data($year);

        return view('schedule.planner.index', ['weeks'=>$weeks, 'schedule_list'=>$schedule_list, 'year'=>$year, 'users'=>$users]);
    }

    public function store(StoreSchedulePlannerRequest $request){

        dump($request->all());
    }
}
