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
  $date = ['Date'];
  $day = ['Day'];
  for($d = 1; $d<= $data['days_in_month']; $d++){
    $date[] = $d;
    $day[] = $weekdays[$data['date']->day($d)->weekday()];
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
    $day_period = CarbonPeriod::create($start_date, $end_date);
    $curr_day_list = [];
    $prev_day_list = [];
    
    if($start_date->format('m') != $month && $start_date->format('Y') != $year){
      continue;
    }
    if (array_key_exists($user_id, $events_data)){
      $prev_day_list = $events_data[$user_id];
    }
    if($start_date == $end_date){
      array_push($curr_day_list, (int)$start_date->format('d'));
    } else {
       foreach($day_period as $day){
        array_push($curr_day_list, (int)$day->format('d'));
      }
    }
  
    if ($prev_day_list){
      $events_data[$user_id] = array_merge($prev_day_list, $curr_day_list);
      continue;
    }
    $events_data[$user_id] = $curr_day_list;
    
  }
  return $events_data;
}

function get_users_data($user_id, $events,$year, $month){
  $month_data = month_data($year, $month);
  $events_data = event_by_user($events, $month, $year);
  if (array_key_exists($user_id, $events_data)){
    $user_event_data = $events_data[$user_id];
  }

  $data=[];
    
    for($day = 1; $day<=$month_data['days_in_month']; $day++){
      if (in_array($day, $user_event_data)){
          $data[] = ['day'=>$day, 'event'=>"vacation"];    
          continue;
      }
      $data[] = ['day'=>$day, 'event'=>"no event"];
    }
  return $data;
}

function get_table_data($year, $month, $users, $events){
  $month_data = get_month_date_day($year, $month);
  $table_data = ['month'=>$month_data];
  foreach ($users as $user){
    $user_info = ['id'=>$user->id, 'name'=>$user->name];
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

