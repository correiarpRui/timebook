<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller 
{
    public function index($year){
        
        $calendar_data = generate_calendar_data($year);
        $total_cels = get_total_cels($calendar_data);
        
        $calendar_total_rows['weeks'] =  generate_calendar_week_row ($total_cels);
        $calendar_total_rows['months'] =  generate_calendar_month_rows($calendar_data, $total_cels, $year);
        
        return view('calendar.index', ['year'=>$year, 'calendar_total_rows'=>$calendar_total_rows]);        
    }

    public function store(Request $request, $year){

        // function get_dates($request){
        //     $values = $request->all();
        //     array_shift($values);
        //     $dates = [];
        //     $data = [1=>[],2=>[],3=>[],4=>[],5=>[],6=>[],7=>[],8=>[],9=>[],10=>[],11=>[],12=>[]];

        //     foreach($values as $value){
        //         array_push($dates, explode('-', $value));
        //     }   

        //     foreach($dates as $value){
        //         array_push($data[$value[1]], $value[0]);
        //     }
            
            
        //     return $data;
        // }
        // $dates = get_dates($request);

        $user = User::find(Auth::id());

        $values = $request->all();
        array_shift(($values));

        $prev_date = null;
        $start_date = null;
        $end_date = null;
        $last_checked_date = null;

        foreach ($values as $value){
            $date = Carbon::createFromFormat('d-m-Y', $value);
            $date_day_before = Carbon::createFromFormat('d-m-Y', $value)->subDay();        

            if ($date_day_before != $prev_date && $prev_date !=null && $start_date != null ){
                $end_date = $prev_date;
                $event = new Event([
                    'type'=>'vacation', 
                    'start_date'=> $start_date ? $start_date->format('d-m-Y') : $start_date, 
                    'end_date'=>$end_date ? $end_date->format('d-m-Y') : $end_date]);
                $event->save();
                $user->events()->syncWithoutDetaching($event);
                $user->save();
                $prev_date = $date;
                $start_date = $date;
                $last_checked_date = $date;
            } elseif ($date_day_before == $prev_date){
                $prev_date = $date;
                $last_checked_date = $date;
            } elseif ($prev_date == null){
                $prev_date = $date;
                $start_date = $date;
                $last_checked_date = $date;
            }            
        }
        $event = new Event(['type'=>'vacation', 'start_date'=> $start_date->format('d-m-Y'), 'end_date'=>$last_checked_date->format('d-m-Y') ]);
        $event->save();
        $user->events()->syncWithoutDetaching($event);
        $user->save();
        
        return redirect(route('calendar', $year));
    }
}