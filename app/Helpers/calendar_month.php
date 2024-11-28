<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\DumpCommand;

function month_data ($year, $month){
  $int_year = (int) $year;
  $int_month = (int) $month;
  $date = Carbon::createFromFormat('Y', $int_year);
  $days_in_month = $date->month($int_month)->daysInMonth();
  return ["year"=>$int_year, "month"=>$int_month, 'date'=>$date ,"days_in_month"=>$days_in_month];
}

function  get_month_date_day($year, $month){
  $data = month_data($year, $month);
  $weekdays = ['S', 'M','T','W','T','F','S'];
  $date = ['title'=>'Date', 'values'=>[]];
  $day = ['title'=>'Day', 'values'=>[]];
  for($d = 1; $d<= $data['days_in_month']; $d++){
    $date['values'][] = $d;
    $day['values'][] = $weekdays[$data['date']->day($d)->weekday()];
  }
  $result = ['date' => $date, 'day'=>$day];
  return $result;
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
    
    if($start_date->format('m') != $month || $start_date->format('Y') != $year){
      continue;
    }

    $event_data = ['start'=>$start_day, 'end'=>$end_day, 'range'=>$range ];
    
    $events_data[$user_id][] = $event_data;
    
  }
  
  return $events_data;
}

function sort_data($user_event_data){
  $get_start_day = function ($data){
    return $data['start'];
  };
  $start_days = array_map($get_start_day, $user_event_data);
  sort($start_days);
  $sorted_events = [];
  foreach($start_days as $start_day){
    foreach($user_event_data as $event){
      if($event['start'] === $start_day){
        $sorted_events[] = $event;
        break;
      }
    }
  }
  return $sorted_events;
}

function get_users_data($user_id, $events,$year, $month){
  $month_data = month_data($year, $month);
  $events_data = event_by_user($events, $month, $year);
  $sorted_events = null;
  if (array_key_exists($user_id, $events_data)){
    $sorted_events = sort_data($events_data[$user_id]);
  }
  $data=[];
  $day = 1;

  while($day <= $month_data['days_in_month'] ){
    if($sorted_events != null){
      foreach($sorted_events as $event){
        if($event['start'] == $day){
          $data[]= ['event'=>'vacation', 'range'=>$event['range']];
          $day += ($event['range']);
        }
      }
    }
    $data[] =['event'=>'', 'day'=>$day];
    $day++;
  }
  return $data;
}

function get_table_data($year, $month, $users, $events){
  $month_data = get_month_date_day($year, $month);
  $table_data = ['month'=>$month_data];
  foreach ($users as $user){
    $user_info = ['id'=>$user->id, 'name'=>"$user->first_name $user->last_name"];
    $data = get_users_data($user->id, $events,$year, $month);
    $table_data['users'][$user->id] = ['user_info'=>$user_info, 'data'=>$data];
  }
  return $table_data;
}

// $result = [
//   'month'=>[
//     'date'=>[],
//     'day'=>[]
//   ],
//   'user'=>[
//     'user_info'=>[
//       'id'=>
//       "name"=>
//     ],
//     'data'=>[
//       [
//         'day'=>
//         'event'=>
//       ]
//     ]
//   ]
// ]

