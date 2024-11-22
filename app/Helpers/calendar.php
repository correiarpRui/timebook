<?php

use Carbon\Carbon;

// $weekday = ["", 1, 4, 5 ... startweek ];

$year = 2024;
$holiday_list = [1=>[1],2=>[13],3=>[29],4=>[25],5=>[1,30],6=>[10, 13, 24, 29],7=>[],8=>[15],9=>[],10=>[5],11=>[1],12=>[1,8,25]];
$vacation_list = [3=>[1,4, 5, 10]];
$calendar_months_rows = get_all_month_calendar_rows($year, $holiday_list, $vacation_list);
$max_number_cells = get_max_cells ($calendar_months_rows);

function get_month_data ($month, $year){
  $date = Carbon::createFromFormat('Y', $year);
  $days_in_month = $date->month($month)->daysInMonth();
  $first_weekday = $date->month($month)->firstOfMonth()->weekday();
  $month_name = $date->month($month)->format('F');
  return ['month_name'=>$month_name, 'days_in_month'=>$days_in_month, 'first_weekday'=>$first_weekday];
}

function get_month_calendar_row($month, $year, $holiday_list, $vacation_list){
  $month_data = get_month_data ($month, $year);
  $month_row[] = ['value'=>$month_data['month_name']];
  $current_date = Carbon::now();
  $current_day = $current_date->format('d');
  $current_month = $current_date->format('m');
  $current_year = $current_date->format('Y');
  $vacations = [];
  $holidays = [];

  if ($vacation_list[0] == $year && array_key_exists($month, $vacation_list)){
      $vacations = $vacation_list[$month];
  }
  
  if (array_key_exists($month, $holiday_list )){
      $holidays = $holiday_list[$month];
  }
  
  
  for ($cell = 0; $cell < $month_data['first_weekday']; $cell++){
    $month_row[] = ['value'=>''];
  }
  for ($cell = 1; $cell <= $month_data['days_in_month']; $cell++){
    $data = ['value'=>$cell, 'id'=>"$cell-$month-$year"];
    if ($current_year == $year && $current_month == $month && $current_day == $cell){
      $data['today'] = 1;
    }
    if (in_array($cell, $holidays)){
      $data['holiday'] = 1;
    }
    if (in_array($cell, $vacations)){
      $data['vacation'] = 1;
    }
    $month_row[]= $data;
  }
  return $month_row;
}

function get_all_month_calendar_rows($year, $holiday_list, $vacation_list){
  $calendar_months_rows = [];
  for($month = 1; $month<13; $month++){
    $calendar_months_rows[] = get_month_calendar_row($month, $year, $holiday_list, $vacation_list);
  }
  return $calendar_months_rows;
}

function get_max_cells ($calendar_months_rows){
  $max_number_cells = 0;
  foreach ($calendar_months_rows as $month){
    $number_of_cells = count($month);
    if ($max_number_cells < $number_of_cells){
      $max_number_cells = $number_of_cells;
    }
  }
  return $max_number_cells-1;
}

function get_first_calendar_row($max_number_cells){
  $weekdays = ['S','M','T','W','T','F','S'];
  $first_row = [''];
  for($i=0; $i<$max_number_cells; $i++){
    array_push($first_row, $weekdays[$i%7]);
  }
  return $first_row;
}

function finish_month_rows($max_number_cells, $calendar_month_rows){
  $calendar_month_rows_finished = [];
  foreach($calendar_month_rows as $row){
    $row_num_cells = count($row);
    $num_rows_left = $max_number_cells-$row_num_cells;
    if ($num_rows_left >= 0){
      for($i= 0; $i<=$num_rows_left; $i++){
        $row[] = ['value'=>''];  
      }
    }
    $calendar_month_rows_finished[] = $row;
  }
  return $calendar_month_rows_finished;
}




