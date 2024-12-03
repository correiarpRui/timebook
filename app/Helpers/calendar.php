<?php

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;

function new_get_month_dates ($month, $year){
  $start_of_month = CarbonImmutable::createFromFormat("d-m-Y", "1-$month-$year");
  $end_of_month = $start_of_month->endOfMonth();
  $dates = collect($start_of_month->toPeriod($end_of_month));
  return $dates;
}

function new_get_year_months($year){
  $year_data = [];
  for ($month =1; $month<=12; $month++){
    $year_data[$month] = new_get_month_dates($month, $year);
  }
  return $year_data;
}

function new_get_year_month_size($year_data){
  $year_month_size = [];
  $year_start_weekday = 0;
  $total_cells = 0;
  foreach ($year_data as $month_data){
    $month_start_weekday = $month_data->first()->weekday();
    $month_days = $month_data->count();
    $month_size = $month_start_weekday+$month_days;
    if ($year_start_weekday > $month_start_weekday){
      $year_start_weekday = $month_start_weekday;
    }
    $year_month_size["month_size"][$month_data->first()->format('F')] =  $month_size;
  }
  foreach($year_month_size['month_size'] as $month){
    if($month > $total_cells){
      $total_cells = $month;
    }
  }
  $year_month_size['total_cells'] = $total_cells;
  $year_month_size['year_start_weekday'] = $year_start_weekday;
  return $year_month_size;
}

// not all years have a month starting on sunday
function new_get_first_row($year_month_size){
  $weekdays = ['S','M','T','W','T','F','S'];
  $first_row = [];
  
  for ($cell=0; $cell<$year_month_size['total_cells']; $cell++){
    if ($weekdays[$cell%7] == 'S'){
      $first_row[] = ['value'=> $weekdays[$cell%7], 'weekday' => false];
      continue;
    } 
    $first_row[] = ['value'=> $weekdays[$cell%7], 'weekday' => true];
  }
  return $first_row;
}

function new_month_row($month_data, $total_cells, $start_week_day, $holiday_list, $event_list){
  $month_row = [];
  $start_of_week = $month_data->first()->weekday();
  $month = ltrim($month_data->first()->format('m'),0);

  $cells_before = $start_of_week - $start_week_day;
  for ($cell=$cells_before; $cell>0; $cell--){
    $last_month_day = $month_data->first()->subDays($cell);
    $month_row[] = ['value'=>"", 'event'=>false, 'holiday'=>false, 'id'=>0, 'today'=>false, 'weekday'=>$last_month_day->isweekday()];
  }
  foreach($month_data as $day){
    $value = ltrim($day->format('d'),0);
    if (in_array($value, $holiday_list[$month])){
      $month_row[] = ['value'=>ltrim($day->format('d'),0), 'event'=>false, 'holiday'=>true, 'id'=>$day->format('d-m-Y'), 'today'=>$day->istoday(), 'weekday'=>$day->isweekday()];
      continue;
    } 
    if (array_key_exists($month, $event_list) && in_array($value, $event_list[$month])){
      $month_row[] = ['value'=>ltrim($day->format('d'),0), 'event'=>true, 'holiday'=>false, 'id'=>$day->format('d-m-Y'), 'today'=>$day->istoday(), 'weekday'=>$day->isweekday()];
      continue;
    }
    $month_row[] = ['value'=>ltrim($day->format('d'),0), 'event'=>false, 'holiday'=>false, 'id'=>$day->format('d-m-Y'), 'today'=>$day->istoday(), 'weekday'=>$day->isweekday()];
      
    

  }

  $cells_left = $total_cells-count($month_row);
  for($cell=1; $cell<=$cells_left; $cell++){
    $next_month_day = $month_data->last()->addDays($cell);
    $month_row[] = ['value'=>"", 'event'=>false, 'holiday'=>false, 'id'=>0, 'today'=>false, 'weekday'=>$next_month_day->isweekday()];
  }

  return $month_row;
}

function new_get_event_list($events, $year){
  $event_list = [];
  foreach($events as $event){
    if ($event->year != $year){
      continue;
    }
    if ($event->start_day == $event->end_day){
      $event_list[(int)$event->month][] = (int)$event->start_day;
      continue;
    }
    $event_period = CarbonPeriod::create($event->start_date, $event->end_date);
    foreach($event_period as $day){
      $event_list[(int) $event->month][] = (int)$day->format('d');
    }    
  }
  return $event_list;
}

function new_get_full_calendar($year, $holiday_list, $events){
  $year_data = new_get_year_months($year);
  $year_months_size = new_get_year_month_size($year_data);
  $total_cells = $year_months_size['total_cells'];
  $start_week_day = $year_months_size['year_start_weekday'];
  $first_row = new_get_first_row($year_months_size);
  $event_list = new_get_event_list($events, $year);
  $month_rows = [];
  foreach ($year_data  as $month_data){
    $month_name = $month_data->first()->format('F');
    $month_rows[$month_name] = new_month_row($month_data, $total_cells, $start_week_day, $holiday_list, $event_list);
  }
  return [
    'first_row' => $first_row, 
    'month_rows'=>$month_rows,
    'total_cells' => $total_cells+1
    ];
}





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




