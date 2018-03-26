<?php

namespace App\Helpers\Holiday\Methods;

use App\Helpers\Holiday\Data\HolidayInterface;

abstract class Base
{

    /** @var HolidayInterface */
    protected $holiday;

    /** @var \DateTime */
    protected $searchDate;

    /** @var boolean */
    protected $badHolidayDay = false;

    /**
     * @param HolidayInterface $holiday
     * @param \DateTime $searchDate
     */
    public function __construct(HolidayInterface $holiday, \DateTime $searchDate)
    {
        $this->holiday = $holiday;
        $this->searchDate = $searchDate;
    }

    /**
     * @return boolean
     */
    public function isHoliday()
    {
        if (true === $this->badHolidayDay) {
            return false;
        }
        $dateHoliday = $this->getHolidayDate();
        return $dateHoliday == $this->searchDate;
    }

    /**
     * @return \DateTime
     */
    abstract protected function getHolidayDate();

}
