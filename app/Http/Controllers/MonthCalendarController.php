<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;

class MonthCalendarController extends Controller
{
    public function index($year, $month){
        $users = User::all();
        $events = Event::with('users')->get();
        $holiday_list = [1=>[1],2=>[13],3=>[29],4=>[25],5=>[1,30],6=>[10, 13, 24, 29],7=>[],8=>[15],9=>[],10=>[5],11=>[1],12=>[1,8,25]];


        $table_data = get_table_data($year, $month, $users, $events, $holiday_list);

        $int_month = (int)$month;
        $int_year = (int)$year;
        $date = Carbon::createFromDate($int_year);
        $month_name = $date->month($int_month)->format('F');
        $days_in_month = $date->month($int_month)->daysInMonth();

        dump($table_data);

        return view('calendar.month.index', ['table_data'=>$table_data, 'month_name'=>$month_name, 'year'=>$year, 'month'=>$month, 'days_in_month'=>$days_in_month]);
    }
}
