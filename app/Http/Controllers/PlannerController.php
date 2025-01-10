<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Weekschedule;
use Carbon\CarbonImmutable;

class PlannerController extends Controller
{
    public function index($year, $month){

        $schedule_list = Schedule::get(['id', 'name']);
        $users = User::get(['id','first_name', 'last_name']);

        $month_name = CarbonImmutable::createFromFormat('Y-m', "$year-$month")->format('F');
        $month_data = get_month_data($month, $year);
        $number_of_weeks = count($month_data);
        
        $weeks_number_in_month = [];
        foreach ($month_data as $week){
            $weeks_number_in_month[] = $week->last()['id'];
        }

        $month_schedule_data = [];
        foreach($weeks_number_in_month as $week_number){
            foreach($users as $user){
                if ($month == 12 && $week_number == 1){
                    $week_schedule = Weekschedule::with('schedule')->where('user_id', $user->id)->where('year', $year+1)->where('week_number', $week_number)->get();    

                    if (!$week_schedule->count()){
                        $month_schedule_data[$user->id][$week_number] = ['','','','','','',''];        
                        continue;
                    } 

                    $schedule_name = $week_schedule[0]->schedule->name;
                    foreach (['sunday', 'monday','tuesday','wednesday','thursday','friday','saturday',] as $day_of_week){
                        $week_schedule[0]->schedule->$day_of_week ? $month_schedule_data[$user->id][$week_number][] = $schedule_name : $month_schedule_data[$user->id][$week_number][] ="";
                    }
                    continue;
                }             

                $week_schedule = Weekschedule::with('schedule')->where('user_id', $user->id)->where('year', $year)->where('week_number', $week_number)->get();

                if (!$week_schedule->count()){
                    $month_schedule_data[$user->id][$week_number] =['','','','','','',''];        
                    continue;
                } 

                $schedule_name = $week_schedule[0]->schedule->name;
                foreach (['sunday', 'monday','tuesday','wednesday','thursday','friday','saturday',] as $day_of_week){
                    $week_schedule[0]->schedule->$day_of_week ? $month_schedule_data[$user->id][$week_number][] = $schedule_name : $month_schedule_data[$user->id][$week_number][] ="";
                }
            }
        }

        return view('schedule.planner.testindex', ['schedule_data'=>$month_schedule_data,'month_name'=>$month_name ,'month_weeks'=>$month_data, 'weeks_number'=>$number_of_weeks, 'schedule_list'=>$schedule_list, 'year'=>$year, 'users'=>$users, 'user_schedule'=>$weeks_number_in_month, 'month'=>$month]);
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
