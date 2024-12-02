<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Models\Schedule;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(){

        $schedules = Schedule::all();

        return view('schedule.list.index', ['schedules'=>$schedules]);
    }

    public function create(){

        return view('schedule.list.create');
    }

    public function store(StoreScheduleRequest $request){
        $validated_data = [
            'name'=> $request->validated('name'),
            'morning_start'=> $request->validated('morning_start'),
            'morning_end'=> $request->validated('morning_end'),
            'afternoon_start'=> $request->validated('afternoon_start'),
            'afternoon_end'=> $request->validated('afternoon_end'),
            'monday' => $request->validated('monday') ? true : false,
            'tuesday' => $request->validated('tuesday') ? true : false,
            'wednesday' => $request->validated('wednesday') ? true : false,
            'thursday' => $request->validated('thursday') ? true : false,
            'friday' => $request->validated('friday') ? true : false,
            'saturday' => $request->validated('saturday') ? true : false,
            'sunday' => $request->validated('sunday') ? true : false,
        ];
        Schedule::create($validated_data);

        return redirect(route('schedule.list'));
    }

    public function update($id){
        $schedule = Schedule::find($id);

        return view('schedule.list.update', ['schedule'=>$schedule]);
    }

    public function patch(StoreScheduleRequest $request, $id){
        $validated_data = [
            'name'=> $request->validated('name'),
            'morning_start'=> $request->validated('morning_start'),
            'morning_end'=> $request->validated('morning_end'),
            'afternoon_start'=> $request->validated('afternoon_start'),
            'afternoon_end'=> $request->validated('afternoon_end'),
            'monday' => $request->validated('monday') ? true : false,
            'tuesday' => $request->validated('tuesday') ? true : false,
            'wednesday' => $request->validated('wednesday') ? true : false,
            'thursday' => $request->validated('thursday') ? true : false,
            'friday' => $request->validated('friday') ? true : false,
            'saturday' => $request->validated('saturday') ? true : false,
            'sunday' => $request->validated('sunday') ? true : false,
        ];

        $schedule = Schedule::find($id);
        $schedule->update($validated_data);
        $schedule->save();

        return redirect(route('schedule.list'));
        
    }

    public function destroy($id){
        $schedule = Schedule::find($id);
        $schedule->delete();
        return redirect(route('schedule.list'));
    }
}
