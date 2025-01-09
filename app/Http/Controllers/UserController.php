<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Vacation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Psy\CodeCleaner\EmptyArrayDimFetchPass;

class UserController extends Controller
{
   
    public function testindex(){
        $users = User::all();
        return view('user.testindex', ['users'=>$users]);
    }

    public function testcreate(){

        $roles = Role::all();

        return view('user.testcreate', ['roles'=>$roles]);
    }

    public function store(Request $request){
        $validated_data = $request->validate([
            'first_name'=> ['required'],
            'last_name'=> ['required'],
            'email' => ['required','email', 'unique:users'],
            'birth_date'=>['required', 'date_format:Y-m-d', 'before:today'],            
            'password' => ['required'],
            'role_id' => ['required', Rule::in(["1","2","3"])],
            'vacation_days' => ['required', 'integer']
        ]);        
        $user = User::create([
            'first_name'=> $validated_data['first_name'],
            'last_name'=> $validated_data['last_name'],
            'email'=> $validated_data['email'],
            'birth_date'=> $validated_data['birth_date'],
            'password'=> $validated_data['password'],
            'role_id'=> $validated_data['role_id'],
        ]);
        Vacation::create([
            'user_id'=>$user->id,
            'year'=>date('Y'),
            'vacation_days'=>$validated_data['vacation_days'],
            'vacation_days_left'=>$validated_data['vacation_days']
        ]);
         
        return redirect('/users');
    }

    public function update($id){
        $roles = Role::all();
        $user = User::find($id);
        return view('user.testupdate', ['user'=>$user, 'roles'=>$roles]);
    }

    public function patch(Request $request, $id){

        
        $validated_data = $request->validate([
            'first_name'=> ['required'],
            'last_name'=> ['required'],
            'email' => ['required','email', 'unique:users,email,'.$id],
            'birth_date'=>['required', 'date_format:Y-m-d', 'before:today'],
            'role_id' => ['required', Rule::in(["1","2","3"])],
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
