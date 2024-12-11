<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Holiday;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller 
{
    public function index($year){
        $events = Event::whereHas('users', function($query){
            return $query->where('user_id', Auth::id());
        })->get();

        $holidays = Holiday::whereYear('date', $year)->get();
        $holiday_list = [1=>[],2=>[],3=>[],4=>[],5=>[],6=>[],7=>[],8=>[],9=>[],10=>[],11=>[],12=>[]];

        foreach($holidays as $holiday){
            $date = CarbonImmutable::createFromDate($holiday->date);
            $day = ltrim($date->format('d'),0);
            $month = ltrim($date->format('m'),0);
            $holiday_list[$month][] = $day;
        }
    
        $calendar_data = new_get_full_calendar($year, $holiday_list, $events);

        return view('calendar.year.index', ['year'=>$year, 'calendar_data'=>$calendar_data]);       
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
                    'end_date'=>$end_date ? $end_date->format('d-m-Y') : $end_date,
                    'start_day'=> $start_date ? $start_date->format('d') : $start_date,
                    'end_day'=> $end_date ? $end_date->format('d') : $end_date,
                    'month'=> $start_date ? $start_date->format('m') : $start_date,
                    'year'=> $year,
                    ]);
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
        $event = new Event([
            'type'=>'vacation', 
            'start_date'=> $start_date->format('d-m-Y'), 
            'end_date'=>$last_checked_date->format('d-m-Y'), 
            'start_day'=>$start_date->format('d'),
            'end_day'=>$last_checked_date->format('d'),
            'month'=> $start_date->format('m'),
            'year'=> $year,
        ]);
        $event->save();
        $user->events()->syncWithoutDetaching($event);
        $user->save();
        
        return redirect(route('calendar.year', $year));
    }

    public function index_settings($year){
        
        $months = get_months_last_day($year);    
        
        $holidays = Holiday::whereYear('date', $year)->orderBy('date', 'asc')->get();

        $holidays = $holidays->map(
            function ($holiday){
                $date = CarbonImmutable::createFromDate($holiday->date);
                $holiday->month = $date->format('F');
                $holiday->day = ltrim($date->format('d'),0);
                return $holiday;
            }
        );
        
        return view('calendar.settings', ['year'=>$year, 'months'=>$months[0], 'holidays'=>$holidays]);
    }

    public function store_settings(Request $request){

        $year = CarbonImmutable::now()->format('Y');
        $date = Carbon::createFromFormat("d-m-Y H", "{$request->day}-{$request->month}-{$request->year} 0");
        $request->merge([
            'date'=> $date
        ]);
        
        $validated_data = $request->validate([
            'name'=>['required'],
            'date'=>['required', 'unique:holidays,date']
        ]);

        Holiday::create($validated_data);

        return redirect(route('calendar.settings', $year));
    }

    public function delete_settings($id){
        $year = CarbonImmutable::now()->format('Y');
        $holiday = Holiday::find($id);
        $holiday->delete();
        return redirect(route('calendar.settings', $year));
    }
}

