<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index.index', ['msg' => 'Hello World!']);
    }

    public function find(Request $request)
    {
//        $month    =    '04'; //номер месяца
//        $w1    =    strftime("%W",strtotime("$month/01/2018"));
//        echo $w1;
//        $currentYear = 2018;
//        $d=30;
//        echo $w = date("w", mktime(0,0,0,3,$d,$currentYear));
//        if ($w<4) $d=$d-$w;
//        echo $weekMax = date("W", mktime(0,0,0,3,$d,$currentYear));
//        $date=date("Y-m-d---w", mktime(0,0,0,3,$d,$currentYear));
//        //echo "{$weekMax}==={$date}";
//        die;
//        var_dump(date("d.m.Y", mktime(0,0,0,4,1,2018)));
//        $dat = getdate(time(0,0,0,4,1,2018));
//        var_dump($dat);
//        $dat['mon_week_no'] = ceil(($dat['mday']-$dat['wday']+7)/7);

        return view('index.index', ['msg' => $this->tryFindHoliday($request->date)]);
    }
//1st of January
//7th of January
//From 1st of May till 7th of May
//Monday of the 3rd week of January
//Monday of the last week of March
//Thursday of the 4th week of November

    private function tryFindHoliday($date)
    {
        $msg = 'Work day';

        $holidays = [
            [
                'title' => '1st of January',
                'type' => 'day',
                'date_from' => '1.01',
                'date_to' => '',
                'month' => '',
                'week' => '',
                'day' => '',
                'flag_monday' => false,
            ],
            [
                'title' => '7th of January',
                'type' => 'day',
                'date_from' => '7.01',
                'date_to' => '',
                'month' => '',
                'week' => '',
                'day' => '',
                'flag_monday' => true,
            ],
            [
                'title' => 'From 1st of May till 7th of May',
                'type' => 'interval',
                'date_from' => '1.05',
                'date_to' => '7.05',
                'month' => '',
                'week' => '',
                'day' => '',
                'flag_monday' => false,
            ],
            [
                'title' => 'Monday of the 3rd week of January',
                'type' => 'week',
                'date_from' => '',
                'date_to' => '',
                'month' => '1',
                'week' => '3',
                'day' => '1',
                'flag_monday' => false,
            ],
            [
                'title' => 'Monday of the last week of March',
                'type' => 'week',
                'date_from' => '',
                'date_to' => '',
                'month' => '3',
                'week' => 'last',
                'day' => '1',
                'flag_monday' => false,
            ],
            [
                'title' => 'Thursday of the 4th week of November',
                'type' => 'week',
                'date_from' => '',
                'date_to' => '',
                'month' => '11',
                'week' => '4',
                'day' => '4',
                'flag_monday' => false,
            ],
        ];

        foreach ($holidays as $holiday) {
            if ($this->test($holiday, $date)) {
                $msg = $holiday['title'];
                break;
            }
        }

        return $msg;
    }

    private function test($holiday, $date)
    {
        switch ($holiday['type']) {
            case 'day':
                $date = new \DateTime($date);
                $year = $date->format('Y');
                $dateHoliday = new \DateTime($holiday['date_from'] . '.' . $year);

                return $dateHoliday == $date;
                break;
            case 'interval':
                $date = new \DateTime($date);
                $year = $date->format('Y');
                $dateHolidayFrom = new \DateTime($holiday['date_from'] . '.' . $year);
                $dateHolidayTo = new \DateTime($holiday['date_to'] . '.' . $year);

                return ($dateHolidayFrom <= $date) && ($date <= $dateHolidayTo);
                break;
            case 'week':
                $weekDay = $holiday['day'] == '7'? '0' : $holiday['day'];
                if ('last' === $holiday['week']) {
                    $date = new \DateTime($date);
                    $year = $date->format('Y');

                    $lastDay = cal_days_in_month(CAL_GREGORIAN, $holiday['month'], $year);

                    $dayOfWeekFirstDayOfMonth = date('w', strtotime($lastDay . '.' . $holiday['month'] . '.' . $year));

                    if ($dayOfWeekFirstDayOfMonth != $weekDay) {
                        for ($lastDay = 31; $lastDay >= 1; $lastDay--) {
                            $dayOfWeekFirstDayOfMonth = date('w', strtotime($lastDay . '.' . $holiday['month'] . '.' . $year));

                            if ($dayOfWeekFirstDayOfMonth == $weekDay) {

                                break;
                            }
                        }
                    }
//                    exit();
                    $dateHoliday = new \DateTime($lastDay . '.' . $holiday['month'] . '.' . $year);
                } else {
                    $date = new \DateTime($date);
                    $year = $date->format('Y');
                    $j = 1;
                    for ($day = 1; $j <= (int)$weekDay; $day++) {
                        $dayOfWeekFirstDayOfMonth = date('w', strtotime($day . '.' . $holiday['month'] . '.' . $year));
                        if ($dayOfWeekFirstDayOfMonth == $weekDay) {
                            $j++;
                        }
                    }

//                    $day = $this->compute_day($holiday['week'], $holiday['day'], $holiday['month'], $year);

                    $dateHoliday = new \DateTime($day - 1 . '.' . $holiday['month'] . '.' . $year);
                }
//                $date1 = date_create($date);
//                $date=date_format($date1, 'm.d');
//                $dateTwo=date_format($date1, 'd.m.Y');
//
//                $timestamp=strtotime($dateTwo);
//                $DATE=getdate($timestamp);
//
//                $day = $holiday['day'];
//                $week = $holiday['week'];
//                $month = $holiday['month'];
//
//                $_day = $DATE['wday'];
//                $_week = date("W",$timestamp);
//                $_month = $DATE['mon'];
//                $_year = $DATE['year'];
//
//                function weekOfMounth($date) {
//                    $first=strtotime(date("Y.m.01",$date));
//                    return intval(date("W",$date))-intval(date("W",$first))+1;
//                }
//                $datee=strtotime($dateTwo);
//
//                echo weekOfMounth($datee);
//
//                if($day == $_day AND $week == $_week) {
//                    return true;
//                }
                return $dateHoliday == $date;
                break;
        }

        return false;
    }

    private function compute_day($weekNumber, $dayOfWeek, $monthNumber, $year)
    {
        // порядковый номер дня недели первого дня месяца $monthNumber
        $dayOfWeekFirstDayOfMonth = (int)date('w', mktime(0, 0, 0, $monthNumber, 1, $year));

        // сколько дней осталось до дня недели $dayOfWeek относительно дня недели $dayOfWeekFirstDayOfMonth
        $diference = 0;

        // если нужный день недели $dayOfWeek только наступит относительно дня недели $dayOfWeekFirstDayOfMonth
        if ($dayOfWeekFirstDayOfMonth <= $dayOfWeek)
        {
            var_dump(1);
            $diference = $dayOfWeek - $dayOfWeekFirstDayOfMonth;
        }
        // если нужный день недели $dayOfWeek уже прошёл относительно дня недели $dayOfWeekFirstDayOfMonth
        else
        {
            $diference = 7 - $dayOfWeekFirstDayOfMonth + $dayOfWeek;
        }
        var_dump($diference);
        var_dump($weekNumber);
        return 1 + $diference + ($weekNumber - 1) * 7;
    }

    function dd($val)
    {
        var_dump($val);
    }
//
//    function dt($val)
//    {
//        var_dump($val);exit();
//    }
}
