<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Record;
use App\Models\Weekschedule;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecordController extends Controller
{
    public function index(){
        $records = Record::with('user')->get();
        return view('records.index', ['records'=>$records]);
    }

    public function create(){

        $users = User::all();
        
        return view('records.create', ['users' =>$users]);
    }

    public function store(Request $request){

        $validated_user = $request->validate([
            'user_id' => ['required', 'exists:users,id']
        ]);
        
        $date = Carbon::now();
        $year = (int) $date->format('Y');
        $week  = $date->weekOfYear();
        $day_of_week = ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'][$date->dayOfWeek()];

        if ($date->dayOfWeek() == 0){
            $week = $week+1;
            if($week == 53){
                $week = 1;
                $year = $year + 1 ;
            }
        }

        $week_schedule = Weekschedule::with('schedule')->where('week_number', $week)->where('user_id', $validated_user['user_id'])->where('year', $year)->get();
        if ($week_schedule[0]->schedule->$day_of_week == 1){
            Record::create([
                'date' => $date->format('d-m-Y'),
                'user_id'=>$validated_user['user_id'],
                'week_day'=>$day_of_week,
                'morning_start' => $week_schedule[0]->schedule->morning_start,
                'morning_end' => $week_schedule[0]->schedule->morning_end,
                'afternoon_start' => $week_schedule[0]->schedule->afternoon_start,
                'afternoon_end' => $week_schedule[0]->schedule->afternoon_end,
                'is_present' => 1   
            ]);
        } 
        return redirect(route('records'));
    }   

    public function update($id){
        $record = Record::where('id', $id)->with('user')->get();
        return view('records.update', ['record'=>$record]);
    }

    public function patch(Request $request, $id){
        $validated_data = $request->validate([
            'morning_start'=>['required', 'date_format:H:i'],
            'morning_end'=>['required', 'date_format:H:i','after:morning_start'],
            'afternoon_start'=>['required', 'date_format:H:i','after:morning_end'],
            'afternoon_end'=>['required', 'date_format:H:i', 'after:afternoon_start'],
            'is_present'=>['sometimes', 'nullable'],
        ]);
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
        $record = Record::where('id', $id)->with('user')->get();
        return view('records.show', ['record'=>$record]);
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
}
