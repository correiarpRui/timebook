<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Holiday;
use App\Models\Vacation;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller 
{
    public function index($year){        
        $user_vacations = Vacation::where('user_id', Auth::id())->where('year', $year)->first();

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

        return view('calendar.year.testindex', ['year'=>$year, 'calendar_data'=>$calendar_data, 'user_vacations'=>$user_vacations]);       
    }

    public function store(Request $request, $year){        
        $user = User::find(Auth::id());
        $vacation = Vacation::where('user_id', Auth::id())->where('year', $year)->first();
        
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

                $start_day = $start_date ? $start_date->format('d') : $start_date;
                $end_day = $end_date ? $end_date->format('d') : $end_date;

                $range = ($end_day-$start_day)+1;
                $vacation_days_left = $vacation->vacation_days_left -$range;

                $event = new Event([
                    'type'=>'vacation', 
                    'start_date'=> $start_date ? $start_date->format('d-m-Y') : $start_date, 
                    'end_date'=>$end_date ? $end_date->format('d-m-Y') : $end_date,
                    'start_day'=> $start_day,
                    'end_day'=> $end_day,
                    'month'=> $start_date ? $start_date->format('m') : $start_date,
                    'year'=> $year,
                    'status_id'=>1,
                    ]);
                $event->save();
                $vacation->update(['vacation_days_left'=>$vacation_days_left]);
                $vacation->save();
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

        $range =( $last_checked_date->format('d')-$start_date->format('d') )+ 1;
        $vacation_days_left = $vacation->vacation_days_left -$range;
        
        $event = new Event([
            'type'=>'vacation', 
            'start_date'=> $start_date->format('d-m-Y'), 
            'end_date'=>$last_checked_date->format('d-m-Y'), 
            'start_day'=>$start_date->format('d'),
            'end_day'=>$last_checked_date->format('d'),
            'month'=> $start_date->format('m'),
            'year'=> $year,
            'status_id'=>1,
        ]);
        $event->save();
        $vacation->update(['vacation_days_left'=>$vacation_days_left]);
        $vacation->save();
        $user->events()->syncWithoutDetaching($event);
        $user->save();
        
        return redirect(route('calendar.year', $year));
    }

    public function index_holidays($year){        
        
        $months = get_months_last_day($year);    
        // $holidays = Holiday::whereYear('year', $year)->orderBy('date', 'asc')->get();
        $holidays = Holiday::whereIn('year', [$year])->orWhereNull('year')->get();

        $holidays = $holidays->map(
            function ($holiday) use ($year){
                $holiday->date = Carbon::createFromFormat("Y-m-d","$year-$holiday->month-$holiday->day"); 
                $holiday->month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'][$holiday->month-1];
                return $holiday;
            }
        );

        $holidays = $holidays->sortBy('date')->values();
        
        return view('calendar.holidays', ['year'=>$year, 'months'=>$months[0], 'holidays'=>$holidays]);
    }

    public function holidays_store(Request $request){

        

        if (!$request->input("month") || !$request->input("day") || !$request->input("name")){
            return back()->withErrors(['error'=>'All fields except year are required.'])->withInput();
        }        
        
        $validated_data = $request->validate([
            'name'=>['required'],
            'year'=>['nullable', 'integer'],
            'month'=>['required', 'integer'],
            'day'=>['required', 'integer']
        ]);

        Holiday::create($validated_data);

        $year = Carbon::now()->format('Y');        

        return redirect(route('calendar.holidays', $year));
    }

    public function delete_holidays($id){
        $year = CarbonImmutable::now()->format('Y');
        $holiday = Holiday::find($id);
        $holiday->delete();
        return redirect(route('calendar.holidays', $year));
    }

    public function generate_holiday($year){
        $last_year = $year-1;
        $last_year_holiday = Holiday::whereYear('date', $last_year)->orderBy('date', 'asc')->get();

        $last_year_holiday->map(
            function($holiday){
                $old_date = Carbon::createFromDate($holiday->date);
                $new_holiday = ['name'=>$holiday->name, 'date'=> $old_date->addYear()];
                Holiday::create($new_holiday);
            }
        );

        return redirect(route('calendar.settings', $year));
    }
}

