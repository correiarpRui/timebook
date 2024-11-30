<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchedulePlannerController extends Controller
{
    public function index(){
        return view('schedule.planner.index');
    }
}
