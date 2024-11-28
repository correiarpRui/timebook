<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Psy\CodeCleaner\EmptyArrayDimFetchPass;

class UserController extends Controller
{
    public function index(){

        $users = User::all();
        
        return view('user.index', ['users'=> $users]);
    }

    public function create(){

        $roles = Role::all();
        $schedules = Schedule::all();

        return view('user.create', ['roles'=>$roles, 'schedules'=>$schedules]);
    }

    public function store(Request $request){

        $validated_data = $request->validate([
            'first_name'=> ['required'],
            'last_name'=> ['required'],
            'email' => ['required','email', 'unique:users'],
            'birth_date'=>['required', 'date_format:Y-m-d', 'before:today'],
            'password' => ['required'],
            'role_id' => ['required', Rule::in(["1","2","3"])],
            'schedule_id' => ['sometimes', 'nullable']
        ]);

        if(!$validated_data['schedule_id']){
            $validated_data['schedule_id'] = null;
        }

        User::create($validated_data);

        return redirect('/users');
    }

    public function update($id){
        $roles = Role::all();
        $schedules = Schedule::all();
        $user = User::find($id);
        return view('user.update', ['user'=>$user, 'roles'=>$roles, 'schedules'=>$schedules]);
    }

    public function patch(Request $request, $id){
        $validated_data = $request->validate([
            'first_name'=> ['required'],
            'last_name'=> ['required'],
            'email' => ['required','email', 'unique:users,email,'.$id],
            'birth_date'=>['required', 'date_format:Y-m-d', 'before:today'],
            'role_id' => ['required', Rule::in(["1","2","3"])],
            'schedule_id' => ['sometimes', 'nullable']
        ]);

        if(!$validated_data['schedule_id']){
            $validated_data['schedule_id'] = null;
        }

        $user = User::find($id);
        $user->update($validated_data);
        $user->save();
        return redirect(route('users'));
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect(route('users'));
    }

    
}
