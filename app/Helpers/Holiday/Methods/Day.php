<?php

namespace App\Helpers\Holiday\Methods;

class Day extends Base
{

    /**
     * @return \DateTime
     */
    protected function getHolidayDate()
    {
        $year = $this->searchDate->format('Y');
        $dateHoliday = new \DateTime($this->holiday->getDateFrom() . '.' . $year);
        $isHoliday = $dateHoliday == $this->searchDate;
        $weekDay = date(
            'w',
            strtotime($dateHoliday->format('d') . '.' . $dateHoliday->format('m') . '.' . $year)
        );

        if (
            $this->holiday->getIsCheckMonday()
            && false === $isHoliday
            && ('6' == $weekDay || '0' == $weekDay)
        ) {
            $cof = '6' == $weekDay? 2:1;
            $mondayDay = (int)$dateHoliday->format('d') + $cof;
            $dateHoliday = new \DateTime($mondayDay . '.' . $dateHoliday->format('m') . '.' . $year);
        }

        return $dateHoliday;
    }

}
