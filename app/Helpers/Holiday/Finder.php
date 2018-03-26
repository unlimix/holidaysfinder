<?php

namespace App\Helpers\Holiday;

use Illuminate\Http\Request;
use App\Helpers\Holiday\Data\HolidayInterface;
use App\Helpers\Holiday\Methods\Base;
use App\Helpers\Holiday\Methods\Day;
use App\Helpers\Holiday\Methods\Interval;
use App\Helpers\Holiday\Methods\Week;
use App\Helpers\Holiday\Methods\Zero;

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
            if ($this->checkHoliday($holiday, $searchDate)) {
                $msg = 'It`s holiday ' . $searchDate->format('d.m.Y') . ': ' . $holiday->getTitle();
                break;
            }
        }

        return $msg;
    }

    /**
     * @param HolidayInterface $holiday
     * @param \DateTime $searchDate
     * @return boolean
     */
    private function checkHoliday(HolidayInterface $holiday, \DateTime $searchDate)
    {
        switch ($holiday->getType()) {
            case HolidayInterface::TYPE_DAY:
                $method = new Day($holiday, $searchDate);
                break;
            case HolidayInterface::TYPE_INTERVAL:
                $method = new Interval($holiday, $searchDate);
                break;
            case HolidayInterface::TYPE_WEEK:
                $method = new Week($holiday, $searchDate);
                break;
            default:
                $method = new Zero($holiday, $searchDate);
                break;
        }

        /** @var Base $method */
        return $method->isHoliday();
    }

}
