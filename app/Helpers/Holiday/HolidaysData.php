<?php

namespace App\Helpers\Holiday;

use App\Helpers\Holiday\Data\Holiday;
use App\Helpers\Holiday\Data\HolidayInterface;

/**
 * 1st of January
 * 7th of January
 * From 1st of May till 7th of May
 * Monday of the 3rd week of January
 * Monday of the last week of March
 * Thursday of the 4th week of November
 */
class HolidaysData implements HolidaysDataInterface
{

    /** @var array */
    private $holidays = [
        [
            'title' => '1st of January',
            'type' => HolidayInterface::TYPE_DAY,
            'date_from' => '1.01',
            'date_to' => '',
            'month' => '',
            'week' => '',
            'weekDay' => '',
            'monday' => false,
        ],
        [
            'title' => '7th of January',
            'type' => HolidayInterface::TYPE_DAY,
            'date_from' => '7.01',
            'date_to' => '',
            'month' => '',
            'week' => '',
            'weekDay' => '',
            'monday' => false,
        ],
        [
            'title' => 'From 1st of May till 7th of May',
            'type' => HolidayInterface::TYPE_INTERVAL,
            'date_from' => '1.05',
            'date_to' => '7.05',
            'month' => '',
            'week' => '',
            'weekDay' => '',
            'monday' => false,
        ],
        [
            'title' => 'Monday of the 3rd week of January',
            'type' => HolidayInterface::TYPE_WEEK,
            'date_from' => '',
            'date_to' => '',
            'month' => '1',
            'week' => '3',
            'weekDay' => '1',
            'monday' => false,
        ],
        [
            'title' => 'Monday of the last week of March',
            'type' => HolidayInterface::TYPE_WEEK,
            'date_from' => '',
            'date_to' => '',
            'month' => '3',
            'week' => 'last',
            'weekDay' => '1',
            'monday' => false,
        ],
        [
            'title' => 'Thursday of the 4th week of November',
            'type' => HolidayInterface::TYPE_WEEK,
            'date_from' => '',
            'date_to' => '',
            'month' => '11',
            'week' => '4',
            'weekDay' => '4',
            'monday' => false,
        ],
    ];

    /**
     * @return array
     */
    public function getHolidays()
    {
        $holidays = [];

        foreach ($this->holidays as $holiday) {
            $holidays[] = new Holiday(
                $holiday['title'],
                $holiday['type'],
                $holiday['date_from'],
                $holiday['date_to'],
                $holiday['month'],
                $holiday['week'],
                $holiday['weekDay'],
                $holiday['monday']
            );
        }

        return $holidays;
    }
}
