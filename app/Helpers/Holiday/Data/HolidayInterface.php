<?php

namespace App\Helpers\Holiday\Data;

interface HolidayInterface
{
    const TYPE_DAY = 'day';
    const TYPE_INTERVAL = 'interval';
    const TYPE_WEEK = 'week';

    const MONDAY = '1';
    const TUESDAY = '2';
    const WEDNESDAY = '3';
    const THURSDAY = '4';
    const FRIDAY = '5';
    const SATURDAY = '6';
    const SUNDAY = '0';

    const LAST_WEEK = 'last';

    /** @var string */
    public function getTitle();

    /** @var string */
    public function getType();

    /** @var string */
    public function getDateFrom();

    /** @var string */
    public function getDateTo();

    /** @var string */
    public function getMonth();

    /** @var string */
    public function getWeek();

    /** @var string */
    public function getWeekDay();

    /** @var boolean */
    public function getIsCheckMonday();
}
