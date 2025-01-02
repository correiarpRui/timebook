<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\DumpCommand;

function month_data ($year, $month){
  $int_year = (int) $year;
  $int_month = (int) $month;
  $days_in_month = Carbon::createFromFormat('Y', $int_year)->month($int_month)->daysInMonth();
  $start_month = Carbon::createFromFormat('Y', $int_year)->month($int_month)->startOfMonth();
  $end_month = Carbon::createFromFormat('Y', $int_year)->month($int_month)->endOfMonth();
  $dates = CarbonPeriod::create($start_month, $end_month);
  
  $dates_of_month = ["year"=>$int_year, "month"=>$int_month, 'dates'=>[] ,"days_in_month"=>$days_in_month];
  foreach($dates as $date){
    $dates_of_month['dates'][] = $date;
  }
  return $dates_of_month;
}

function new_get_header_data($month_data, $holiday_list){
  $weekdays = ['S', 'M','T','W','T','F','S'];
  foreach($month_data['dates'] as $date){
    $dates_row[] = ['day'=> ltrim($date->format('d'),0),'week_day'=> $weekdays[$date->weekday()],'weekday'=> $date->isweekday(), 'today'=>$date->isToday(), 'holiday'=>false];
    
  }
  foreach($holiday_list as $day){
    $dates_row[$day-1]['holiday'] = true; 
  }
  return ['date'=>$dates_row];
}

function event_by_user($events, $month, $year){
  $events_data = [];
  foreach ($events as $event){
    $start_date = Carbon::createFromFormat('d-m-Y', $event->start_date);
    $end_date = Carbon::createFromFormat('d-m-Y', $event->end_date);
    $user_id = $event->users[0]->id;
    
    $start_day =(int) $start_date->format('d');
    $end_day =(int) $end_date->format('d');
    $range = ($end_day-$start_day)+1;
    $status = $event->status_id;
    $event_id = $event->id;
    $event_data = [];

    if($start_date->format('m') != $month || $start_date->format('Y') != $year){
      continue;
    }

    for ($day = $start_day; $day <= $end_day; $day++){
      $event_data[$day] = $day;  
    }

    $event_data['start'] = $start_day;
    $event_data['range'] = $range;
    $event_data['status_id'] = $status;
    $event_data['event_id'] = $event_id;

    $events_data[$user_id][] = $event_data; //where is variable stored
  }
  return $events_data;
}

function sort_event_start_day($user_event_data){
  $get_start_day = function ($data){
    return $data['start'];
  };

  $list_of_start_days = array_map($get_start_day, $user_event_data);
  sort($list_of_start_days);

  $sorted_events = [];
  foreach($list_of_start_days as $start_day){
    foreach($user_event_data as $event){
      if($event['start'] === $start_day){
        $sorted_events[] = $event;
        break;
      }
    }
  }
  return $sorted_events;
}

function get_users_data($user_id, $events,$year, $month, $month_data, $holiday_list){
  $events_data = event_by_user($events, $month, $year);
  $sorted_events = null;
  if (array_key_exists($user_id, $events_data)){
    $sorted_events = sort_event_start_day($events_data[$user_id]);
  }
  $data=[];
  $day = 1;
  
  foreach($month_data['dates'] as $date){
    $day = ltrim($date->format('d'),0);
    if($sorted_events != null){
      foreach($sorted_events as $event){
        if ($event['start'] == $day){
          $data[]= ['day'=>$day, 'event'=>'vacation', 'start'=>1,'range'=>$event['range'], 'status_id'=>$event['status_id'], 'event_id'=>$event['event_id'], 'weekday'=> $date->isweekday(), 'today'=>$date->isToday(), 'holiday'=>false];
        }
        if (array_key_exists($day, $event) && $event['start'] != $day){
          $data[]= ['day'=>$day, 'event'=>'vacation', 'weekday'=> $date->isweekday(), 'today'=>$date->isToday(), 'holiday'=>false];
        } 
      }
      if(!array_key_exists($day-1, $data)){
        $data[]= ['day'=>$day, 'event'=>'', 'weekday'=> $date->isweekday(), 'today'=>$date->isToday(), 'holiday'=>false];
      }
    }else{
      $data[] =['day'=>$day,'event'=>'', 'weekday'=> $date->isweekday(), 'today'=>$date->isToday(), 'holiday'=>false];
    }
  }

  foreach($holiday_list as $day){
    $data[$day-1]['holiday'] = true; 
  }
 
  return $data;
}

function get_table_data($year, $month, $users, $events, $holiday_list){
  
  
  $holiday_in_month = $holiday_list[$month];
  
  
  $month_data = month_data ($year, $month);
  
  $headers_data = new_get_header_data($month_data, $holiday_in_month);
  $table_data = ['month'=>$headers_data];

  foreach ($users as $user){
    $user_info = ['id'=>$user->id, 'name'=>"$user->first_name $user->last_name"];
    $data = get_users_data($user->id, $events,$year, $month, $month_data, $holiday_in_month);
    $table_data['users'][$user->id] = ['user_info'=>$user_info, 'data'=>$data];
  }
  return $table_data;
}

