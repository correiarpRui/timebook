<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    public function index($year){
        $events = Event::with('users')->where('year', $year)->get();
        return view('calendar.vacation.index', ['events'=>$events]);
    }

    public function patch(Request $request, $event_id){
        $validated_data = $request->validate([
            'status_id'=> ['required', Rule::in(['2','3'])]
        ]);

        $event = Event::find($event_id);
        $event->update($validated_data);    
        $event->save();

        return redirect()->back();
    }  

     public function destroy($event_id){
        $event = Event::find($event_id);
        $user = Event::find($event_id)->users()->get();
        $range = ($event->end_day-$event->start_day)+1;
        $vacation_days_left = $user[0]->vacation_days_left+$range;
        $user[0]->update(['vacation_days_left'=>$vacation_days_left]);
        $user[0]->save();
        $event->delete();
        return redirect()->back();

    }

    public function update($event_id){
        $event = Event::with('users')->where('id', $event_id)->get();
        return view('calendar.vacation.update', ['event'=>$event]);
    }

    public function edit($event_id){
        
    }
}
