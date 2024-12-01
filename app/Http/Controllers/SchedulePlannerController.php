<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchedulePlannerController extends Controller
{
    public function index(){

        $year = '2024';

        $weeks = get_month_dates($year);

        return view('schedule.planner.index', ['weeks'=>$weeks]);
    }
}
