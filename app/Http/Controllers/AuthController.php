<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect(route('dashboard.index'));
        }
        return back()->withErrors([
            'email'=> "Email or password not valid."
        ])->onlyInput('email');
    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }
}
