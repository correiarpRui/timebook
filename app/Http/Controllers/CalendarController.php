<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
    
        $holiday_list = [1=>[1],2=>[13],3=>[29],4=>[25],5=>[1,30],6=>[10, 13, 24, 29],7=>[],8=>[15],9=>[],10=>[5],11=>[1],12=>[1,8,25]];
    
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

    public function settings(){
        
        $year =(int) Carbon::now()->format("Y");
        $months = get_months_last_day($year);    
        dump($months);
        $holidays = [
            1=>[
                1=>"New Year's Day"
            ],
            2=>[
                13=>'Carnival'
            ],
            3=>[
                29=>'Good Friday',
                31=>'Easter Sunday'
            ],
            4=>[
                25=>'Liberty Day'
            ],
            5=>[
                1=>'Labor Day',
                30=>'Corpus Christi'
            ],
            6=>[
                1=>'Portugal Day'
            ],
            7=>[],
            8=>[
                15=>'Assumption of Mary'
            ],
            9=>[],
            10=>[
                5=>'Republic Day',
            ],
            11=>[
                1=>"All Saints' day",
            ],
            12=>[
                1=>'Restoration of Independence',
                8=>'Feast of the Immaculate Conception',
                25=>'Christmas Day'
            ]
        ];
        return view('calendar.settings', ['year'=>$year, 'months'=>$months[0], 'holidays'=>$holidays]);
    }
}

