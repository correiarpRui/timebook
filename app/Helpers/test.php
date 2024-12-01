<?php

use Carbon\Carbon;
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

function get_month_dates ( $year){

  $int_year = (int)$year;
  
  $first_day_year = Carbon::createFromFormat('Y', $int_year)->firstOfYear();
  $last_day_year = Carbon::createFromFormat('Y', $int_year)->lastOfYear();

  $year_dates = CarbonPeriod::create($first_day_year, $last_day_year);
  $weekdays = ['S', 'M','T','W','T','F','S'];
  $week_number = 1;
  $dates = [];
  $number_days_from_last_year = abs(0- $first_day_year->weekday());

//maybe not needed / change form number
  if ($number_days_from_last_year != 0){
    for ($day = $number_days_from_last_year; $day > 0; $day--){
      $day_before = 32-$day;
      $year_before = $year-1;
      $date_from_year_before = Carbon::createFromFormat('d-m-Y', "$day_before-12-$year_before");
      $dates[1][] =  ['day'=>$date_from_year_before->format('d'), 'value'=>$date_from_year_before->format('d-m-Y'), 'weekday'=>$date_from_year_before->weekday()];
    }
  }
  
  foreach ($year_dates as $date){ 
    $dates[$week_number][] = [
      'day'=>ltrim($date->format('d'),0), 
      'value'=>$date->format('d-m-Y'), 
      'weekday'=>$date->weekday()];
    if(count($dates[$week_number]) == 7){
      $week_number++;
    }
  }
  return $dates;  
}





