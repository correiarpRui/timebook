<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\DumpCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
    
        $events = Event::whereHas('users', function($query){
            return $query->where('user_id', Auth::id());
        })->get();
        
        $events_list = [];

        foreach($events as $event){
            array_push($events_list, [$event->type, $event->start_date, $event->end_date]);
        }
    
        return view('dashboard.index', ['events_list'=>$events_list]);
    }
}
