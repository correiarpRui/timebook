<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;

class MonthCalendarController extends Controller
{
    public function index($year, $month){
        $users = User::all();
        $events = Event::with('users')->get();
        
        $table_data = get_table_data($year, $month, $users, $events);
        
        

        return view('calendar.month.index', ['table_data'=>$table_data]);
    }
}
