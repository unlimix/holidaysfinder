<?php

namespace App\Helpers\Holiday;

class Data implements DataInterface
{
    private $title;
    private $type;
    private $dateFrom;
    private $dateTo;
    private $month;
    private $week;
    private $weekDay;
    private $monday;

    public function __construct($title,
                                $type,
                                $date_from,
                                $date_to,
                                $month,
                                $week,
                                $weekDay,
                                $monday)
    {
        $this->title = $title;
        $this->type = $type;
        $this->dateFrom = $date_from;
        $this->dateTo = $date_to;
        $this->month = $month;
        $this->week = $week;
        $this->weekDay = $weekDay;
        $this->monday = $monday;

    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    public function getDateTo()
    {
        return $this->dateTo;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getWeek()
    {
        return $this->week;
    }

    public function getWeekDay()
    {
        return $this->weekDay == '7'? '0' : $this->weekDay;
    }

    public function getIsCheckMonday()
    {
        return $this->monday;
    }
}
