<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Record;
use Carbon\Carbon;
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

        $user = User::where('id', $request->user_id)->with('schedule')->get();

        $days_week = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        $date = Carbon::now();

        if($user[0]->schedule){
            $data = [
                'date' => $date->format('d-m-Y'),
                'user_id'=>$user[0]->id,
                'week_day'=>$days_week[$date->dayOfWeek()],
                'morning_start' => $user[0]->schedule->morning_start,
                'morning_end' => $user[0]->schedule->morning_end,
                'afternoon_start' => $user[0]->schedule->afternoon_start,
                'afternoon_end' => $user[0]->schedule->afternoon_end,
                'is_present' => 1    
            ];
            Record::create($data);
            return redirect(route('records'));
        } else {
            return redirect('/record/create');
        }
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
