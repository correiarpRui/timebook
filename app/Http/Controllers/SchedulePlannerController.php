<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;

use App\Models\Weekschedule;
use Carbon\CarbonImmutable;

class SchedulePlannerController extends Controller
{
    public function index($year, $month){

        $schedule_list = Schedule::all();
        $users = User::all();

        $month_weeks = get_month_data($month, $year);
        
        $user_schedule = [];
        foreach ($month_weeks as $week){
            $user_schedule[] = $week->last()['id'];
        }

        $schedule_data = [];
        foreach($user_schedule as $week_number){
            foreach($users as $user){
                if ($month == 12 && $week_number == 1){
                    $week_schedule = Weekschedule::with('schedule')->where('user_id', $user->id)->where('year', $year+1)->where('week_number', $week_number)->get();
                    if (!$week_schedule->count()){
                        $schedule_data[$user->id][$week_number] = ['','','','','','',''];        
                        continue;
                    } 
                    $schedule_name = $week_schedule[0]->schedule->name;
                    $week_schedule[0]->schedule->sunday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
                    $week_schedule[0]->schedule->monday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
                    $week_schedule[0]->schedule->tuesday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
                    $week_schedule[0]->schedule->wednesday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
                    $week_schedule[0]->schedule->thursday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
                    $week_schedule[0]->schedule->friday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
                    $week_schedule[0]->schedule->saturday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
                    continue;
                }                
                $week_schedule = Weekschedule::with('schedule')->where('user_id', $user->id)->where('year', $year)->where('week_number', $week_number)->get();
                if (!$week_schedule->count()){
                    $schedule_data[$user->id][$week_number] =['','','','','','',''];        
                    continue;
                } 
                $schedule_name = $week_schedule[0]->schedule->name;
                $week_schedule[0]->schedule->sunday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
                $week_schedule[0]->schedule->monday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
                $week_schedule[0]->schedule->tuesday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
                $week_schedule[0]->schedule->wednesday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
                $week_schedule[0]->schedule->thursday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
                $week_schedule[0]->schedule->friday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
                $week_schedule[0]->schedule->saturday ? $schedule_data[$user->id][$week_number][] = $schedule_name : $schedule_data[$user->id][$week_number][] ="";
            }
        }
        $month_name = CarbonImmutable::createFromFormat('Y-m', "$year-$month")->format('F');
        
        $weeks_number =count($month_weeks);
        $week_days = ['Su','Mo','Tu','We', 'Th', 'Fr', 'Sa'];
    
        return view('schedule.planner.index', ['schedule_data'=>$schedule_data,'month_name'=>$month_name ,'month_weeks'=>$month_weeks, 'week_days'=>$week_days, 'weeks_number'=>$weeks_number, 'schedule_list'=>$schedule_list, 'year'=>$year, 'users'=>$users, 'user_schedule'=>$user_schedule, 'month'=>$month]);
    }

    public function store(Request $request){

        $validated_data = $request->validate([
            'year'=> ['required'],
            'month'=>['required'],
            'user_id'=> ['required'],
            'week_number'=> ['required'],
            'schedule_id'=> ['required'],
        ]);
        $year =(int) $validated_data['year'];
        $month = (int) $validated_data['month'];

        if ($validated_data['month'] == 12 && $validated_data['week_number'] == 1){
            $validated_data['year'] = $validated_data['year'] + 1;
        }
        
        Weekschedule::create([
            'user_id'=> $validated_data['user_id'],
            'schedule_id'=> $validated_data['schedule_id'],
            'year'=> $validated_data['year'],
            'week_number'=> $validated_data['week_number'],
        ]);

        return redirect(route('schedule.planner', [$year, $month]));
    }
}
