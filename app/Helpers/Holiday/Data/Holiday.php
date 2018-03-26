<?php

namespace App\Helpers\Holiday\Data;

class Holiday implements HolidayInterface
{

    /** @var string */
    private $title;

    /** @var string */
    private $type;

    /** @var string */
    private $dateFrom;

    /** @var string */
    private $dateTo;

    /** @var string */
    private $month;

    /** @var string */
    private $week;

    /** @var string */
    private $weekDay;

    /** @var boolean */
    private $monday;

    /**
     * @param string $title
     * @param string $type
     * @param string $dateFrom
     * @param string $dateTo
     * @param string $month
     * @param string $week
     * @param string $weekDay
     * @param boolean $monday
     */
    public function __construct($title,
                                $type,
                                $dateFrom,
                                $dateTo,
                                $month,
                                $week,
                                $weekDay,
                                $monday)
    {
        $this->title = $title;
        $this->type = $type;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->month = $month;
        $this->week = $week;
        $this->weekDay = $weekDay;
        $this->monday = $monday;

    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * @return string
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @return string
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * @return string
     */
    public function getWeekDay()
    {
        return $this->weekDay;
    }

    /**
     * @return boolean
     */
    public function getIsCheckMonday()
    {
        return $this->monday;
    }
}
