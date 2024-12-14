<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;
use Carbon\CarbonImmutable;

class SchedulePlannerController extends Controller
{
    public function index($year, $month){

        $schedule_list = Schedule::all();
        $users = User::all();

        $user_schedule = [];

        $month_weeks = get_month_data($month, $year);
        
        foreach ($month_weeks as $week){
            $user_schedule[] = $week->last()['id'];
        }

        $month_name = CarbonImmutable::createFromFormat('Y-m', "$year-$month")->format('F');
        
        $weeks_number =count($month_weeks);
        $week_days = ['Su','Mo','Tu','We', 'Th', 'Fr', 'Sa'];
    
        return view('schedule.planner.index', ['month_name'=>$month_name ,'month'=>$month_weeks, 'week_days'=>$week_days, 'weeks_number'=>$weeks_number, 'schedule_list'=>$schedule_list, 'year'=>$year, 'users'=>$users, 'user_schedule'=>$user_schedule]);
    }

    public function store(Request $request){

        dump($request->all());

    }
}
