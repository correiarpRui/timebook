<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Event;
use App\Models\Weekschedule;
use Carbon\CarbonImmutable;

class PlannerController extends Controller
{
    public function index($year, $month){

        $schedule_list = Schedule::get(['id', 'name']);
        $users = User::get(['id','first_name', 'last_name']);
        $events = Event::with('users', 'status')->get();
    
        $month_name = CarbonImmutable::createFromFormat('Y-m', "$year-$month")->format('F');
        // every day of month with 
            // day_number
            // week_number
            // month_number
            // value day-month-year
            // weekday_name
        $month_data = get_month_data($month, $year);

        
        // at the end from month_data array len
        //used to define grid col number
        $number_of_weeks = sizeof($month_data)/7; 

        $month_data_w_holidays = add_month_holiday($month_data, $month, $year); // adds holidays to the month data

        
        $month_data_w_holidays_schedules = add_user_schedule($month_data_w_holidays, $year);

        dd($month_data_w_holidays_schedules);
        

        $month_data_w_hol_sch_events = add_user_events($month_data_w_holidays_schedules, $events);

        $weeks_number_in_month = [];
        
        for ($i= 6; $i<= sizeof($month_data); $i+=7){
            $weeks_number_in_month[] = $month_data[$i]['week_number'];
        }               

        return view('schedule.planner.testindex', ['month_name'=>$month_name ,'month_weeks'=>$month_data_w_holidays_schedules, 'weeks_number'=>$number_of_weeks, 'schedule_list'=>$schedule_list, 'year'=>$year, 'users'=>$users, 'user_schedule'=>$weeks_number_in_month, 'month'=>$month]);
    }

    public function store(Request $request){
        
        $validated_data = $request->validate([
            'year'=> ['required'],
            'month'=>['required'],
            'user_id'=> ['required'],
            'week_number'=> ['required'],
            'schedule_id'=> ['required'],
        ]);
        $year = $validated_data['year'];
        $month =  $validated_data['month'];

        if ($validated_data['month'] == 12 && $validated_data['week_number'] == 1){
            $validated_data['year'] = $validated_data['year'] + 1;
        }
        
        Weekschedule::updateOrCreate([
            'user_id'=> $validated_data['user_id'],
            'year'=> $validated_data['year'],
            'week_number'=> $validated_data['week_number'],
        ], ['schedule_id'=> $validated_data['schedule_id']]);

        return redirect(route('schedule.planner', [$year, $month]));
    }
}
