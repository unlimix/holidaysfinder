<?php

namespace App\Helpers\Holiday;

class HolidaysData implements HolidaysDataInterface
{
    //1st of January
//7th of January
//From 1st of May till 7th of May
//Monday of the 3rd week of January
//Monday of the last week of March
//Thursday of the 4th week of November
    /** @var array */
    private $holidays = [
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

    public function getHolidays()
    {
        $holidays = [];
        foreach ($this->holidays as $holiday) {
            $holidays[] = new Data(
                $holiday['title'],
                $holiday['type'],
                $holiday['date_from'],
                $holiday['date_to'],
                $holiday['month'],
                $holiday['week'],
                $holiday['day'],
                $holiday['flag_monday']
            );
        }

        return $holidays;
    }
}
