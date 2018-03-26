<?php

namespace App\Helpers\Holiday\Methods;

class Week extends Base
{
    protected function getHolidayDate()
    {
        $year = $this->searchDate->format('Y');
        $holidayWeekDay = $this->holiday->getWeekDay();
        $holidayWeek = $this->holiday->getWeek();

        if ('last' === $holidayWeek) {
            $lastDay = cal_days_in_month(CAL_GREGORIAN, $this->holiday->getMonth(), $year);
            $weekDay = date('w', strtotime($lastDay . '.' . $this->holiday->getMonth() . '.' . $year));

            if ($weekDay != $holidayWeekDay) {
                for ($lastDay = 31; $lastDay >= 1; $lastDay--) {
                    $weekDay = date('w', strtotime($lastDay . '.' . $this->holiday->getMonth() . '.' . $year));

                    if ($weekDay == $holidayWeekDay) {
                        break;
                    }
                }
            }

            $dateHoliday = new \DateTime($lastDay . '.' . $this->holiday->getMonth() . '.' . $year);
        } else {
            $week = 1;
            $holidayDay = 0;

            for ($day = 1; $week <= (int)$holidayWeek; $day++) {
                $weekDay = date('w', strtotime($day . '.' . $this->holiday->getMonth() . '.' . $year));

                if ($week == (int)$holidayWeek && $weekDay == $holidayWeekDay) {
                    $holidayDay = $day;
                    break;
                }

                if ($weekDay == '0') {
                    $week++;
                }
            }

            if (0 === $holidayDay) {
                return false;
            }

            $dateHoliday = new \DateTime($day . '.' . $this->holiday->getMonth() . '.' . $year);
        }

        return $dateHoliday;
    }
}
