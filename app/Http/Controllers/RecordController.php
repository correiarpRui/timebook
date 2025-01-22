<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use App\Models\Record;
use App\Models\Weekschedule;
use Carbon\Carbon;
// use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class RecordController extends Controller
{
    public function index(){
        $records = Record::with('user')->get();
        return view('records.testindex', ['records'=>$records]);
    }

    public function create(){

        $users = User::all();
        $schedules = Schedule::all();
        // $testusers = User::whereHas('weekschedule')->get();
        // dd($testusers);
        
        return view('records.testcreate', ['users' =>$users, 'schedules'=>$schedules]);
    }

    public function store(Request $request){
        $validated_user = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'date'=>['required', 'before:tomorrow'],
            'schedule_id' => ['required']
        ]);

        $schedule = Schedule::find($validated_user['schedule_id']);
    
        Record::create([
            'date' => CarbonImmutable::createFromDate($validated_user['date'])->format('d-m-Y'),
            'user_id'=>$validated_user['user_id'],
            'week_day'=>['sunday','monday','tuesday','wednesday','thursday','friday','saturday'][CarbonImmutable::createFromDate($validated_user['date'])->dayOfWeek()],
            'morning_start' => $schedule->morning_start,
            'morning_end' => $schedule->morning_end,
            'afternoon_start' => $schedule->afternoon_start,
            'afternoon_end' => $schedule->afternoon_end,
            'is_present' => 1  
        ]);

        return redirect(route('records'));
    }   

    public function update($id){
        $record = Record::where('id', $id)->with('user')->first();
        return view('records.testupdate', ['record'=>$record]);
    }

    public function patch(Request $request, $id){
        $validated_data = $request->validate([
            'morning_start'=>['required', 'date_format:H:i'],
            'morning_end'=>['required', 'date_format:H:i','after:morning_start'],
            'afternoon_start'=>['required', 'date_format:H:i','after:morning_end'],
            'afternoon_end'=>['required', 'date_format:H:i', 'after:afternoon_start'],
            'is_present'=>['sometimes', 'nullable'],
        ]);

        dd($validated_data);

        $record = Record::find($id);
        $record->update($validated_data);
        if (!$request->has('is_present')){
            $record->update(['is_present'=> 0]);
        }
        $record->save();
        return redirect(route('records'));
    }

    public function destroy($id){
        $record = Record::find($id);
        $record->delete();
        return redirect(route('records'));
    }

    public function show($id){
        $record = Record::where('id', $id)->with('user')->first();
        return view('records.testshow', ['record'=>$record]);
    }

    public function store_file(Request $request, $id){
        $request->validate(['file_upload' => ['file']]);

        if ($request->hasFile('file_upload')){
            $file_upload = Storage::disk('public')->put('/', $request->file('file_upload'));
            $file_url = Storage::url($file_upload);
            $record = Record::find($id);
            $record->file_name = $file_upload;
            $record->file_location = $file_url;
            $record->save();
            return redirect(route('records'));
        }
        return redirect(route('record.show', $id));
    }

    public function store_notes(Request $request, $id){
        $validated_data = $request->validate(['notes'=>['sometimes', 'nullable', 'string']]);
        $record = Record::find($id);
        $record->notes = $validated_data["notes"];
        $record->save();
        return redirect(route('record.show', $id));
    }

    public function auto_generate_record(){
        
        // $week = CarbonImmutable::now()->startofWeek(Carbon::SUNDAY)->weekOfYear();
        // if ($week == 52){
        //     $week = 1;
        // } else{
        //     $week++;
        // }
        // $year = (int) Carbon::now()->format('Y');
        // $day_of_week = ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'][Carbon::now()->dayOfWeek()];

        // $week_schedule = Weekschedule::with('schedule')->where('user_id', $validated_user['user_id'])->where('year', $year)->where('week_number', $week)->first();
                
        // if ($week_schedule->schedule->$day_of_week == 1){       
        //      Record::create([
        //         'date' => CarbonImmutable::now()->format('d-m-Y'),
        //         'user_id'=>$validated_user['user_id'],
        //         'week_day'=>$day_of_week,
        //         'morning_start' => $week_schedule->schedule->morning_start,
        //         'morning_end' => $week_schedule->schedule->morning_end,
        //         'afternoon_start' => $week_schedule->schedule->afternoon_start,
        //         'afternoon_end' => $week_schedule->schedule->afternoon_end,
        //         'is_present' => 1   
        //     ]);
        // }

    }
}
