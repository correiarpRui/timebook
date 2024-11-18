<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show($id){
        $user = User::find($id);

        return view('profile', ['user'=> $user]);
    }

    public function patch(Request $request, $id){
        $validated_data = $request->validate([
            'name'=> ['required'],
            'email' => ['required','email', 'unique:users,email,'.$id],
        ]);
        $user = User::find($id);
        $user->update($validated_data);
        $user->save();
        return redirect(route('profile.show', $id));
    }

    public function patch_password(Request $request, $id){
        $validated_date = $request->validate([
            'current_password'=>['required'],
            'password'=>['required'],
        ]);
        $user = User::find($id);

        if (Hash::check($validated_date['current_password'], $user->password)){
            $user->update(['password'=>$validated_date['password']]);
            return redirect(route('profile.show', $id));
        }

        return back()->withErrors([
            'current_password'=> "Password is invalid"
        ]);
    }
}