<?php

namespace App\Helpers\Holiday\Data;

interface HolidayInterface
{
    const TYPE_DAY = 'day';
    const TYPE_INTERVAL = 'interval';
    const TYPE_WEEK = 'week';

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
