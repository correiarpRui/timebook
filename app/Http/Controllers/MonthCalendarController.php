<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Holiday;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class MonthCalendarController extends Controller
{
    public function index($year, $month){

        $users = User::all();
        $events = Event::with('users', 'status')->get();

        $holidays = Holiday::whereYear('date', $year)->get();
        $holiday_list = [1=>[],2=>[],3=>[],4=>[],5=>[],6=>[],7=>[],8=>[],9=>[],10=>[],11=>[],12=>[]];

        foreach($holidays as $holiday){
            $date_holiday = CarbonImmutable::createFromDate($holiday->date);
            $day_holiday = ltrim($date_holiday->format('d'),0);
            $month_holiday = ltrim($date_holiday->format('m'),0);
            $holiday_list[$month_holiday][] = $day_holiday;
        }

        $table_data = get_table_data($year, $month, $users, $events, $holiday_list);

        $int_month = (int)$month;        
        $int_year = (int)$year;
        $date = Carbon::createFromDate($int_year);

        $month_name = $date->month($int_month)->format('F');
        $days_in_month = $date->month($int_month)->daysInMonth();

        return view('calendar.month.testindex', ['table_data'=>$table_data, 'month_name'=>$month_name, 'year'=>$year, 'month'=>$month, 'days_in_month'=>$days_in_month]);
    }
}
