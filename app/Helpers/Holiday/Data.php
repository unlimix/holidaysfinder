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
    private $day;
    private $monday;

    public function __construct($title,
                                $type,
                                $date_from,
                                $date_to,
                                $month,
                                $week,
                                $day,
                                $monday)
    {
        $this->title = $title;
        $this->type = $type;
        $this->dateFrom = $date_from;
        $this->dateTo = $date_to;
        $this->month = $month;
        $this->week = $week;
        $this->day = $day;
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

    public function getDay()
    {
        return $this->day;
    }

    public function getMonday()
    {
        return $this->monday;
    }
}
