<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchedulePlannerRequest;
use Illuminate\Http\Request;
use App\Models\Schedule;

class SchedulePlannerController extends Controller
{
    public function index(){

        $schedule_list = Schedule::all();

        $year = '2026';

        $weeks = get_year_data($year);

        return view('schedule.planner.index', ['weeks'=>$weeks, 'schedule_list'=>$schedule_list]);
    }

    public function store(StoreSchedulePlannerRequest $request){

        $validated_data = [
            '1'=> $request->validated('1'),
        ];

        dump($validated_data);
    }
}
