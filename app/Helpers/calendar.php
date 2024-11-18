<?php

use Carbon\Carbon;

function generate_month_row($year, $month){
  $current_day = Carbon::now()->format('d');
  $current_month = Carbon::now()->format('m');
  $current_year = Carbon::now()->format('Y');
  $date = Carbon::createFromDate($year);
  $month_name = $date->month($month)->format('F');
  $first_weekday = $date->month($month)->firstOfMonth()->weekday();
  $days_in_month = $date->month($month)->daysInMonth();        
  $row = "<td class='border border-gray-400 text-left p-2'>{$month_name}</td>";
  $day = 1;                                        
  for ($i=0; $i<35; $i++){
      if($i < $first_weekday && $day<=$days_in_month){
          $row.= "<td class='border border-gray-400 text-left p-2'></td>";
          continue;     
      } 
      if($day<=$days_in_month && $day == $current_day && $month == $current_month && $year == $current_year){
          $row.= "<td class='border border-gray-400 bg-[rgb(155,245,9)] text-left p-2'>{$day}</td>";
          $day++;
          continue;   
      }
      if ($day<=$days_in_month){
          $row.= "<td class='border border-gray-400 text-left p-2 '>{$day}</td>";
          $day++;
          continue;   
      } 
      $row.= "<td class='border border-gray-400 text-left p-2'></td>"; 
  }
  return $row;         
}

function generate_calendar($year){    
    $calendar = [];
    for ($month = 1; $month<13; $month++){
        $row = generate_month_row($year, $month);
        array_push($calendar, $row);
    }
    return $calendar;  
}

