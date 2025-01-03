<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Vacation;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    public function index($year){
        $events = Event::with('users')->where('year', $year)->get();
        return view('calendar.vacation.index', ['events'=>$events]);
    }

    public function approve(Request $request, $event_id){
        $validated_data = $request->validate([
            'status_id'=> ['required', Rule::in(['2','3'])]
        ]);

        $event = Event::find($event_id);
        $event->update($validated_data);    
        $event->save();

        return redirect()->back();
    } 

    public function patch(Request $request, $event_id){

        $event = Event::find($event_id);
        $user = Event::find($event_id)->users()->first();
        $vacation = Vacation::where('user_id', $user->id)->where('year', $event->year)->first();
        $date = CarbonImmutable::createFromFormat('m-Y', "$event->month"."-"."$event->year")->lastOfMonth()->format('d');
        

        $validated_data = $request->validate([
            'start_day'=>['required', "integer", 'min:1', "max:$date"],
            'end_day'=>['required',  "integer", "min:$request->start_day", "max:$date"]
        ]);

        $start_date = CarbonImmutable::createFromFormat('d-m-Y', "$validated_data[start_day]"."-"."$event->month"."-"."$event->year")->format('d-m-Y');
        $end_date = CarbonImmutable::createFromFormat('d-m-Y', "$validated_data[end_day]"."-"."$event->month"."-"."$event->year")->format('d-m-Y');

        $prev_range = ($event->end_day-$event->start_day)+1;
        $new_range = ($request->end_day-$request->start_day)+1;
        $diff_ranges = $prev_range-$new_range;
        $vacation_days_left = $vacation->vacation_days_left+($diff_ranges);

        $vacation->update(['vacation_days_left'=>$vacation_days_left]);
        $vacation->save();

        $event->update([
            'start_day'=>$validated_data['start_day'],
            'end_day'=>$validated_data['end_day'],
            'start_date'=>$start_date,
            'end_date'=>$end_date
        ]);
        $event->save();

        return redirect()->route('calendar.vacation', $event->year);
    }

     public function destroy($event_id){
        $event = Event::find($event_id);
        $user = Event::find($event_id)->users()->first();
        $vacation = Vacation::where('user_id', $user->id)->where('year', $event->year)->first();
        $range = ($event->end_day-$event->start_day)+1;
        $vacation_days_left = $vacation->vacation_days_left+$range;
        $vacation->update(['vacation_days_left'=>$vacation_days_left]);
        $vacation->save();
        $event->delete();
        return redirect()->back();

    }

    public function update($event_id){
        $event = Event::with('users')->where('id', $event_id)->first();
        $months = get_months_last_day($event->year);
        $month = $months[0][(int) $event->month -1];
        return view('calendar.vacation.update', ['event'=>$event, 'month'=>$month]);
    }

}
