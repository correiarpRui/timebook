<?php

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;

function get_month_data($month, $year){
    $start_of_month = CarbonImmutable::createFromFormat('Y-m-d', "$year-$month-1");
    $month_name = $start_of_month->format('F');
    $end_of_month = $start_of_month->endOfMonth();
    $start_of_week = $start_of_month->startOfWeek(Carbon::SUNDAY);
    $end_of_week = $end_of_month->endOfWeek(Carbon::SATURDAY);
    $dates = collect($start_of_week->toPeriod($end_of_week)->toArray());
    $weeks = $dates->map(fn($date)=>['day'=>$date->day, 'value'=>$date->format('d-m-Y'), 'id'=>"$date->weekOfYear", 'month'=>$date->format('m')])->chunk(7);
    return $weeks;
}

function get_year_data ($year){
  $months = [];
  for ($month = 1; $month <= 12; $month++){
    $month_name = Carbon::createFromFormat('m', "$month")->format('F');  
    $months[$month_name] = get_month_data($month, $year, $month_name);
  }
  return $months;
}


// settings

function get_months_last_day($year){
  $months = [];
  for ($month =1; $month<=12; $month++ ){
    $month_start = CarbonImmutable::createFromFormat('m-Y', "$month-$year");
    $month_name = $month_start->format('F');
    $days_in_month = $month_start->daysInMonth();
    $months[] = ['name'=>$month_name, 'days'=>$days_in_month, 'number'=>$month];
  }
  return [$months];
}





