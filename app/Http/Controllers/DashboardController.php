<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        $user = User::find(Auth::id());
        

        $events = Event::whereHas('users', function($query){
            return $query->where('user_id', Auth::id());
        })->get();
        
        
        foreach($events as $event){
            dump($event->type, $event->start_date, $event->end_date);
        }


        return view('dashboard.index');
    }
}
