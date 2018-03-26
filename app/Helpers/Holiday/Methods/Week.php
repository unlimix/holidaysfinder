<?php

namespace App\Helpers\Holiday\Methods;

use App\Helpers\Holiday\Data\HolidayInterface;

class Week extends Base
{
    protected function getHolidayDate()
    {
        if (HolidayInterface::LAST_WEEK === $this->holiday->getWeek()) {
            return $this->getHolidayDateOfTheLastWeek();
        }

        return $this->getHolidayDateOfTheSomeWeek();
    }

    /**
     * return \DateTime
     */
    private function getHolidayDateOfTheLastWeek()
    {
        $year = $this->searchDate->format('Y');
        $lastDay = cal_days_in_month(CAL_GREGORIAN, $this->holiday->getMonth(), $year);
        $weekDay = date('w', strtotime($lastDay . '.' . $this->holiday->getMonth() . '.' . $year));
        $holidayWeekDay = $this->holiday->getWeekDay();

        if ($weekDay != $holidayWeekDay) {
            for ($lastDay = 31; $lastDay >= 1; $lastDay--) {
                $weekDay = date('w', strtotime($lastDay . '.' . $this->holiday->getMonth() . '.' . $year));

                if ($weekDay == $holidayWeekDay) {
                    break;
                }
            }
        }

        return new \DateTime($lastDay . '.' . $this->holiday->getMonth() . '.' . $year);
    }

    /**
     * return \DateTime
     */
    private function getHolidayDateOfTheSomeWeek()
    {
        $year = $this->searchDate->format('Y');
        $holidayWeekDay = $this->holiday->getWeekDay();
        $holidayWeek = $this->holiday->getWeek();

        $week = 1;
        $holidayDay = 0;

        for ($day = 1; $week <= (int)$holidayWeek; $day++) {
            $weekDay = date('w', strtotime($day . '.' . $this->holiday->getMonth() . '.' . $year));

            if ($week == (int)$holidayWeek && $weekDay == $holidayWeekDay) {
                $holidayDay = $day;
                break;
            }

            if ($weekDay == HolidayInterface::SUNDAY) {
                $week++;
            }
        }

        if (0 === $holidayDay) {
            $this->badHolidayDay = true;
        }

        return new \DateTime($holidayDay . '.' . $this->holiday->getMonth() . '.' . $year);
    }
}
