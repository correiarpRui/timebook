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

        $user = User::find(Auth::id());
    
        $events = Event::whereHas('users', function($query){
            return $query->where('user_id', Auth::id());
        })->get();
        
        $events_list = [];

        foreach($events as $event){
            array_push($events_list, [$event->type, $event->start_date, $event->end_date]);
        }

        // foreach ($events_list as $event){
        //     $start_date = Carbon::createFromFormat('d-m-Y', $event[1]);
        //     $end_date = Carbon::createFromFormat('d-m-Y', $event[2]);
        
        //     $date_range = CarbonPeriod::create($start_date, $end_date);
        //     foreach ($date_range as $date){
        //         dump($date);
        //     }
        // }
    
        return view('dashboard.index', ['events_list'=>$events_list]);
    }
}
