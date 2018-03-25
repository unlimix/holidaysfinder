<?php

namespace App\Helpers\Holiday;

use Illuminate\Http\Request;

class Finder
{
    /** @var array */
    private $holidays = [];

    /**
     * @param HolidaysDataInterface $holidaysData
     */
    public function __construct(HolidaysDataInterface $holidaysData)
    {
        $this->holidays = $holidaysData->getHolidays();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getDayStatus(Request $request)
    {
        if (empty($request->date)) {
            return '';
        }
        $msg = 'Work day';

        foreach ($this->holidays as $holiday) {
            if ($this->test($holiday, $request->date)) {
                $msg = $holiday->getTitle();
                break;
            }
        }

        return $msg;
    }

    /**
     * @param DataInterface $holiday
     * @param string $date
     * @return boolean
     */
    private function test(DataInterface $holiday, $date)
    {
        switch ($holiday->getType()) {
            case 'day':
                $date = new \DateTime($date);
                $year = $date->format('Y');
                $dateHoliday = new \DateTime($holiday->getDateFrom() . '.' . $year);

                return $dateHoliday == $date;
                break;
            case 'interval':
                $date = new \DateTime($date);
                $year = $date->format('Y');
                $dateHolidayFrom = new \DateTime($holiday->getDateFrom() . '.' . $year);
                $dateHolidayTo = new \DateTime($holiday->getDateTo() . '.' . $year);

                return ($dateHolidayFrom <= $date) && ($date <= $dateHolidayTo);
                break;
            case 'week':
                $weekDay = $holiday->getDay() == '7'? '0' : $holiday->getDay();
                if ('last' === $holiday->getWeek()) {
                    $date = new \DateTime($date);
                    $year = $date->format('Y');

                    $lastDay = cal_days_in_month(CAL_GREGORIAN, $holiday->getMonth(), $year);

                    $dayOfWeekFirstDayOfMonth = date('w', strtotime($lastDay . '.' . $holiday->getMonth() . '.' . $year));

                    if ($dayOfWeekFirstDayOfMonth != $weekDay) {
                        for ($lastDay = 31; $lastDay >= 1; $lastDay--) {
                            $dayOfWeekFirstDayOfMonth = date('w', strtotime($lastDay . '.' . $holiday->getMonth() . '.' . $year));

                            if ($dayOfWeekFirstDayOfMonth == $weekDay) {

                                break;
                            }
                        }
                    }
//                    exit();
                    $dateHoliday = new \DateTime($lastDay . '.' . $holiday->getMonth() . '.' . $year);
                } else {
                    $date = new \DateTime($date);
                    $year = $date->format('Y');
                    $j = 1;
                    for ($day = 1; $j <= (int)$weekDay; $day++) {
                        $dayOfWeekFirstDayOfMonth = date('w', strtotime($day . '.' . $holiday->getMonth() . '.' . $year));
                        if ($dayOfWeekFirstDayOfMonth == $weekDay) {
                            $j++;
                        }
                    }

//                    $day = $this->compute_day($holiday['week'], $holiday['day'], $holiday['month'], $year);

                    $dateHoliday = new \DateTime($day - 1 . '.' . $holiday->getMonth() . '.' . $year);
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
}
