<?php

use Carbon\Carbon;

function generate_month_data($year, $month){
  $date = Carbon::createFromDate($year);
  $first_weekday = $date->month($month)->firstOfMonth()->weekday();
  $days_in_month = $date->month($month)->daysInMonth();
  $month_name = $date->month($month)->format('F');
  return ['month_name'=> $month_name,'first_weekday'=> $first_weekday, 'days_in_month'=>$days_in_month, 'total_cels' => ($first_weekday + $days_in_month)];
}   

function generate_calendar_data($year){
  $calendar_data = [];  
  
  for($month =1; $month < 13; $month++){
      $calendar_data[$month] = generate_month_data($year, $month);
  }
  return $calendar_data;
}

function get_total_cels($calendar_data){
  $total_cels = 0;
  foreach ($calendar_data as $month){
    if ($month['total_cels'] > $total_cels){
      $total_cels = $month['total_cels'];
    }
  }
  return $total_cels;
}

function generate_calendar_week_row($total_cels){
    $weekdays = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
    $week_row = [''];
    for ($cell = 0; $cell < $total_cels; $cell++){
      array_push($week_row, $weekdays[$cell%7]);
    }

    return $week_row;
}

// function generate_calendar_month_rows($calendar_data, $total_cels){
//   $calendar_month_row = [];
  
//   for ($row = 1; $row<13; $row++){
//     $calendar_month_row[$row] = [$calendar_data[$row]['month_name']];
    
//     for ($cell = 0; $cell < $total_cels; $cell++){
//       if ($cell < $calendar_data[$row]['first_weekday']){
//         array_push($calendar_month_row[$row], "");
//         continue;
//       }
//       if (($cell+1)-$calendar_data[$row]['first_weekday'] <= $calendar_data[$row]['days_in_month']){
//       array_push($calendar_month_row[$row], ($cell+1)-$calendar_data[$row]['first_weekday']);
//       continue;
//       }
//       array_push($calendar_month_row[$row], "");
//     }
//   }

//   return $calendar_month_row;
// }



function generate_calendar_month_rows($calendar_data, $total_cells, $year){
  $calendar_month_row = [];
  $holiday_list = [
    1=>[1],
    2=>[13],
    3=>[29],
    4=>[25],
    5=>[1,30],
    6=>[10, 13, 24, 29],
    7=>[],
    8=>[15],
    9=>[],
    10=>[5],
    11=>[1],
    12=>[1,8,25],
  ];
  $current_date = Carbon::now();
  $current_day = $current_date->format('d');
  $current_month = $current_date->format('m');
  $current_year = $current_date->format('Y');

  for ($month = 1; $month<13; $month++){
    $cells_left = $total_cells;
    $calendar_month_row[$month] = [];
    array_push($calendar_month_row[$month], ['value'=>$calendar_data[$month]['month_name'],'date'=>"",'attributes'=> ""]);
    for ($cell = 0; $cell < $calendar_data[$month]['first_weekday']; $cell++){
      array_push($calendar_month_row[$month], ['value'=>"",'date'=>"", 'attributes'=> ""]);
      $cells_left--;
    }
    for($cell = 1; $cell <= $calendar_data[$month]['days_in_month']; $cell++){

      $attributes = '';

      foreach ($holiday_list[$month] as $day){
        if ($cell == $day){
          $attributes = 'holiday';
        }
      }

      if ($current_year == $year && $current_month == $month && $current_day == $cell){
          $attributes = 'today';
      }
    
      array_push($calendar_month_row[$month], ['value'=>$cell, 'date'=>"$cell-$month-$year",'attributes'=> $attributes]);  
      $cells_left--;
    }
    for ($cell = $cells_left; $cell > 0; $cell--){
      array_push($calendar_month_row[$month], ['value'=>"", 'date'=>"",'attributes'=> ""]);
      $cells_left--;
    }
  }
  
  return $calendar_month_row;
}
