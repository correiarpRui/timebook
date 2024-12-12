<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchedulePlannerRequest;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;
use Carbon\CarbonImmutable;

class SchedulePlannerController extends Controller
{
    public function index($year, $month){

        $schedule_list = Schedule::all();
        $users = User::all();
        $weeks = get_year_data($year);

        $month_name = CarbonImmutable::createFromFormat('Y-m', "$year-$month")->format('F');
        $month = $weeks[$month_name];

        return view('schedule.planner.index', ['month_name'=>$month_name ,'month'=>$month, 'schedule_list'=>$schedule_list, 'year'=>$year, 'users'=>$users]);
    }

    public function store(Request $request){

        dump($request->all());
    }
}
