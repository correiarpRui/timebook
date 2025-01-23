<?php

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





