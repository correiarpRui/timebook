<?php

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use App\Models\Holiday;
use App\Models\Weekschedule;
use App\Models\User;


function get_month_data($month, $year){
    $start_of_month = CarbonImmutable::createFromFormat('Y-m-d', "$year-$month-1");
    $end_of_month = $start_of_month->endOfMonth();
    $start_of_week = $start_of_month->startOfWeek(Carbon::SUNDAY);
    $end_of_week = $end_of_month->endOfWeek(Carbon::SATURDAY);
    $dates = collect($start_of_week->toPeriod($end_of_week)->toArray());
    $weeks = $dates->map(function($date){
      if ($date->dayOfWeek() == 0 || $date->dayOfWeek() == 6 ){
        return [
      'day'=>$date->day, 
      'week_number'=>"$date->weekOfYear", 
      'month'=>$date->format('m'), 
      'value'=>$date->format('d-m-Y'),
      'weekday' => ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'][$date->dayOfWeek()],
      'color' => "#DFE2E4"
        ];
      }
      return [
      'day'=>$date->day, 
      'week_number'=>"$date->weekOfYear", 
      'month'=>$date->format('m'), 
      'value'=>$date->format('d-m-Y'),
      'weekday' => ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'][$date->dayOfWeek()],
      'color' => "#ffffff"
        ];
       
    });      
    return $weeks;
}

function add_month_holiday($month_data, $month, $year){
    if ($month == 1 ){
        $last_month = null;
        $next_month = $month_data->last()['month'];
    } elseif($month == 12) {
        $last_month = $month_data->first()['month'];
        $next_month = 1;
    } else {
        $last_month = $month_data->first()['month'];
        $next_month = $month_data->last()['month'];
    }

    $holidays = Holiday::whereIn('year', [$year])->orWhereNull('year')->get(); //fixed holidays have a year field of null, others have year field specific for that year
    $month_holidays = $holidays->whereIn('month', [$last_month, $month, $next_month]); //even if jan stats on saturday, the last holiday would be more than a week before.

    $data = [];
    foreach($month_data as $day){
      foreach ($month_holidays as $holiday) {
        if ($day['day'] == $holiday['day'] && $day['month'] == $holiday['month']){
              $day['holiday'] = true;
              $day['color'] = "#bfe17f";
              break;
        } 
      }
      $data[] = $day;
    }

    //try chunk data at the end
    // $month_data_w_holiday = array_chunk($data, 7); 
    // return $month_data_w_holiday;
    return $data;
}

function add_user_schedule ($month_data, $year){
  $users = User::get(['id','first_name', 'last_name']);

  $week_numbers = [];
  for ($i=6; $i<count($month_data) ; $i+=7) { 
    $week_numbers[] = $month_data[$i]['week_number'];
  }
  
  // set first days of week with week_number of first week
  for ($i=0; $i<7; $i++){
    $month_data[$i]['week_number'] = $week_numbers[0];
  }

  $users_schedules = [];
  foreach ($users as $user){
    $users_schedules[$user->id] = Weekschedule::with('schedule')->where('user_id', $user->id)->where('year', $year)->whereIn('week_number', $week_numbers)->get();
  }

  $users_month_schedules = [];
  foreach ($week_numbers as $week_number){
    foreach ($users_schedules as $user_id => $user_schedule){
        $data = $user_schedule->where('week_number', $week_number)->first();
        if ($data){
          $users_month_schedules[$week_number][$user_id] = [
            'name'=>$data->schedule->name,
            'Monday'=>$data->schedule->monday,
            'Tuesday'=>$data->schedule->tuesday,
            'Wednesday'=>$data->schedule->wednesday,
            'Thursday'=>$data->schedule->thursday,
            'Friday'=>$data->schedule->friday,
            'Saturday'=>$data->schedule->saturday,
            'Sunday'=>$data->schedule->sunday,
          ];  
          continue;
        }
        $users_month_schedules[$week_number][$user_id] = [
          'name'=>"",
          'Monday'=>0,
          'Tuesday'=>0,
          'Wednesday'=>0,
          'Thursday'=>0,
          'Friday'=>0,
          'Saturday'=>0,
          'Sunday'=>0,
        ];
    }
  }

  $month_data_with_user_schedules = [];
  foreach($month_data as $day){
    foreach($users_month_schedules[$day['week_number']] as $user_id=>$user_schedule){
      if ($user_schedule[$day['weekday']]){
        $day['users_schedule'][$user_id] = $user_schedule['name'];      
      } else {
        $day['users_schedule'][$user_id] = "";
      }     
      
  }
  $month_data_with_user_schedules[] = $day;
  }
  
  $month_data_with_user_schedules = array_chunk($month_data_with_user_schedules, 7);

  $index_month_data_with_user_schedules = [];
  for ($i = 0; $i < count($month_data_with_user_schedules); $i++){
    $index_month_data_with_user_schedules[$week_numbers[$i]] = $month_data_with_user_schedules[$i]; 
  }

  return $index_month_data_with_user_schedules;
}

function add_user_events($month_data, $events){
}

function get_year_data ($year){
  $months = [];
  for ($month = 1; $month <= 12; $month++){
    $month_name = Carbon::createFromFormat('m', "$month")->format('F');  
    $months[$month_name] = get_month_data($month, $year, $month_name);
  }
  return $months;
}


// settings

function get_months_last_day($year){
  $months = [];
  for ($month =1; $month<=12; $month++ ){
    $month_start = CarbonImmutable::createFromFormat('m-Y', "$month-$year");
    $month_name = $month_start->format('F');
    $days_in_month = $month_start->daysInMonth();
    $months[] = ['name'=>$month_name, 'days'=>$days_in_month, 'number'=>$month];
  }
  return [$months];
}





