<?php
defined('BASEPATH') or die('No direct script access allowed!');

function month($m = 0)
{
    $month_arr = [
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December'
    ];

    if ($m != 0) {
        return $month_arr[$m];
    }
    return $month_arr;
} 

function day($d = 0)
{
    $day_arr = [
        'Monday' => 'Monday',
        'Tuesday' => 'Tuesday',
        'Wednesday' => 'Wednesday',
        'Thursday' => 'Thursday',
        'Friday' => 'Friday',
        'Saturday' => 'Saturday',
        'Sunday' => 'Sunday',
    ];

    if ($d !== 0) {
        return $day_arr[$d];
    }
    return $day_arr;
}

function day_date($date)
{
    $month = month(date('m', strtotime($date)));
    $day = day(date('l', strtotime($date)));
    return $day . ', ' . $month . date('-d', strtotime($date)) . date('-Y', strtotime($date));
}

function day_month($month, $year)
{
    $calendar = CAL_GREGORIAN;
    $day_many = cal_days_in_month($calendar, $month, $year);
    $day_date = [];

    for ($i = 1; $i <= $day_many; $i++) {
        $date =  $year . '-' . $month . '-' . $i;
        $day_date[] = [
            'day' => date('l', strtotime($date)),
            'date' => date('Y-m-d', strtotime($date))
        ];
    }
    return $day_date;
}
