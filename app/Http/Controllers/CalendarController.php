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
        
        $events = Event::whereHas('users', function($query){
            return $query->where('user_id', Auth::id());
        })->get();

        $vacation_list = generate_vacation_list($events);
        

        $holiday_list = [1=>[1],2=>[13],3=>[29],4=>[25],5=>[1,30],6=>[10, 13, 24, 29],7=>[],8=>[15],9=>[],10=>[5],11=>[1],12=>[1,8,25]];
    
    
        $all_month_rows = get_all_month_calendar_rows($year, $holiday_list, $vacation_list);
        $max_cells = get_max_cells ($all_month_rows);
        $finish_calendar_months = finish_month_rows($max_cells, $all_month_rows);
        $fists_row = get_first_calendar_row($max_cells);

        return view('calendar.index', ['year'=>$year, 'calendar_months' => $finish_calendar_months, 'first_row' => $fists_row]);       
    }

    public function store(Request $request, $year){

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

            if ($date_day_before != $prev_date && $prev_date !=null && $start_date != null){
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