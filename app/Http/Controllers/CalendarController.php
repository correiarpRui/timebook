<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index($year){
        
        $current_day = Carbon::now()->format('d');
        $current_month = Carbon::now()->format('m');
        $current_year = Carbon::now()->format('Y');
        $current_month_name = Carbon::now()->format('F');
        $current_date = ['day'=>$current_day, 'month'=>$current_month, 'month_name'=>$current_month_name,'year'=>$current_year];

        $calendar_data = generate_calendar_data($year);
        $total_cels = get_total_cels($calendar_data);
        
        $calendar_total_rows['weeks'] =  generate_calendar_week_row ($total_cels);
        $calendar_total_rows['months'] =  generate_calendar_month_rows($calendar_data, $total_cels, $year);
        
        return view('calendar.index', ['year'=>$year, 'calendar_total_rows'=>$calendar_total_rows]);
        // return view('calendar.index', ['year'=>$year, 'calendar_data'=>$calendar_data, 'current_date'=>$current_date, 'total_cels'=> $total_cels]);
        
    }
}