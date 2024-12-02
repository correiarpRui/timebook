<?php

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;

function generate_vacation_list($events){
  $vacation_list = [null,1=>[],2=>[],3=>[],4=>[],5=>[],6=>[],7=>[],8=>[],9=>[],10=>[],11=>[],12=>[]];

  foreach ($events as $event){
    $start_date = Carbon::createFromFormat('d-m-Y', $event['start_date']);
    $end_date = Carbon::createFromFormat('d-m-Y', $event['end_date']);
    $year = $start_date->format('Y');
    $vacation_list[0] = $year;
    

    if($start_date == $end_date){    
      array_push($vacation_list[$start_date->month],(int)$start_date->format('d'));
      continue;
    }

    $period = CarbonPeriod::create($start_date, $end_date);
    foreach ($period as $date){      
      array_push($vacation_list[$date->month],(int)$date->format('d'));
    }   
    
  } 
  return $vacation_list;
}

function get_year_data ($year){
  $months = [];
  for ($month = 1; $month <= 12; $month++){
    $month_name = Carbon::createFromFormat('m', "$month")->format('F');
    $start_of_month = CarbonImmutable::createFromFormat('Y-m-d', "$year-$month-1");
    $end_of_month = $start_of_month->endOfMonth();
    $start_of_week = $start_of_month->startOfWeek(Carbon::SUNDAY);
    $end_of_week = $end_of_month->endOfWeek(Carbon::SATURDAY);
    $dates = collect($start_of_week->toPeriod($end_of_week)->toArray());
    $weeks = $dates->map(fn($date)=>['day'=>$date->day, 'value'=>$date->format('d-m-Y'), 'week'=>"$month_name-$date->weekOfYear"])->chunk(7);
    $months[$month_name] = $weeks;
  }

  return $months;
}





