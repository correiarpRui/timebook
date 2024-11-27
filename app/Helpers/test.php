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
