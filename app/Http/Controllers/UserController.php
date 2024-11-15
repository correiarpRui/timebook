<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'name'=> ['required'],
            'email' => ['required','email', 'unique:users'],
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
            'name'=> ['required'],
            'email' => ['required','email', 'unique:users,email,'.$id],
            'role_id' => ['required', Rule::in(["1","2","3"])],
            'schedule_id' => ['sometimes', 'nullable']
        ]);

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
