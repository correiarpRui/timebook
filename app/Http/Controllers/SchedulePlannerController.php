<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class SchedulePlannerController extends Controller
{
    public function index(){

        $schedule_list = Schedule::all();

        $year = '2024';

        $weeks = get_year_data($year);

        return view('schedule.planner.index', ['weeks'=>$weeks, 'schedule_list'=>$schedule_list]);
    }

    public function store(Request $request){
        dump($request->input());
    }
}
