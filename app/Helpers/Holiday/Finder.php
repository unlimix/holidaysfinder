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

        $searchDate = new \DateTime($request->date);
        $msg = 'Work day ' . $searchDate->format('d.m.Y') . '!';

        foreach ($this->holidays as $holiday) {
            if ($this->test($holiday, $searchDate)) {
                $msg = 'It`s holiday ' . $searchDate->format('d.m.Y') . ': ' . $holiday->getTitle();
                break;
            }
        }

        return $msg;
    }

    /**
     * @param DataInterface $holiday
     * @param \DateTime $searchDate
     * @return boolean
     */
    private function test(DataInterface $holiday, \DateTime $searchDate)
    {
        $year = $searchDate->format('Y');

        switch ($holiday->getType()) {
            case DataInterface::TYPE_DAY:
                $dateHoliday = new \DateTime($holiday->getDateFrom() . '.' . $year);
                $isHoliday = $this->isHoliday($dateHoliday, $searchDate);
                $weekDay = date(
                    'w',
                    strtotime($dateHoliday->format('d') . '.' . $dateHoliday->format('m') . '.' . $year)
                );
                if (
                    $holiday->getIsCheckMonday()
                    && false === $isHoliday
                    && ('6' == $weekDay || '0' == $weekDay)
                ) {
                    $cof = '6' == $weekDay? 2:1;
                    $mondayDay = (int)$dateHoliday->format('d') + $cof;
                    $isHoliday = $this->isHoliday(
                        new \DateTime($mondayDay . '.' . $dateHoliday->format('m') . '.' . $year),
                        $searchDate
                    );
                }

                return $isHoliday;
                break;
            case DataInterface::TYPE_INTERVAL:
                $dateHolidayFrom = new \DateTime($holiday->getDateFrom() . '.' . $year);
                $dateHolidayTo = new \DateTime($holiday->getDateTo() . '.' . $year);

                return $this->isHolidayInterval($dateHolidayFrom, $dateHolidayTo, $searchDate);
                break;
            case DataInterface::TYPE_WEEK:
                $holidayWeekDay = $holiday->getWeekDay();
                $holidayWeek = $holiday->getWeek();

                if ('last' === $holidayWeek) {
                    $lastDay = cal_days_in_month(CAL_GREGORIAN, $holiday->getMonth(), $year);
                    $weekDay = date('w', strtotime($lastDay . '.' . $holiday->getMonth() . '.' . $year));

                    if ($weekDay != $holidayWeekDay) {
                        for ($lastDay = 31; $lastDay >= 1; $lastDay--) {
                            $weekDay = date('w', strtotime($lastDay . '.' . $holiday->getMonth() . '.' . $year));

                            if ($weekDay == $holidayWeekDay) {
                                break;
                            }
                        }
                    }

                    $dateHoliday = new \DateTime($lastDay . '.' . $holiday->getMonth() . '.' . $year);
                } else {
                    $week = 1;
                    $holidayDay = 0;

                    for ($day = 1; $week <= (int)$holidayWeek; $day++) {
                        $weekDay = date('w', strtotime($day . '.' . $holiday->getMonth() . '.' . $year));

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

                    $dateHoliday = new \DateTime($day . '.' . $holiday->getMonth() . '.' . $year);
                }

                return $this->isHoliday($dateHoliday, $searchDate);
                break;
        }

        return false;
    }

    /**
     * @param \DateTime $dateHoliday
     * @param \DateTime $searchDate
     * @return boolean
     */
    private function isHoliday(\DateTime $dateHoliday, \DateTime $searchDate)
    {
        return $dateHoliday == $searchDate;
    }

    /**
     * @param \DateTime $dateHolidayFrom
     * @param \DateTime $dateHolidayTo
     * @param \DateTime $searchDate
     * @return boolean
     */
    private function isHolidayInterval(\DateTime $dateHolidayFrom, \DateTime $dateHolidayTo, \DateTime $searchDate)
    {
        return ($dateHolidayFrom <= $searchDate) && ($searchDate <= $dateHolidayTo);
    }

}
