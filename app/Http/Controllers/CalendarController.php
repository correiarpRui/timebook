<?php

namespace App\Http\Controllers;

class CalendarController extends Controller
{
    public function index($year){

        return view('calendar.index', ['year'=>$year]);
    }
}