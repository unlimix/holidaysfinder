<?php

namespace App\Helpers\Holiday\Methods;

class Interval extends Base
{

    /** @var \DateTime */
    private $dateHolidayTo;

    /**
     * @return \DateTime
     */
    protected function getHolidayDate()
    {
        $year = $this->searchDate->format('Y');
        $this->dateHolidayTo = new \DateTime($this->holiday->getDateTo() . '.' . $year);
        return new \DateTime($this->holiday->getDateFrom() . '.' . $year);
    }

    /**
     * @return boolean
     */
    public function isHoliday()
    {
        $dateHolidayFrom = $this->getHolidayDate();
        return ($dateHolidayFrom <= $this->searchDate) && ($this->searchDate <= $this->dateHolidayTo);
    }

}
