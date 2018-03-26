<?php

namespace App\Helpers\Holiday;

interface DataInterface
{
    const TYPE_DAY = 'day';
    const TYPE_INTERVAL = 'interval';
    const TYPE_WEEK = 'week';

    public function getTitle();
    public function getType();
    public function getDateFrom();
    public function getDateTo();
    public function getMonth();
    public function getWeek();
    public function getWeekDay();
    public function getIsCheckMonday();
}
