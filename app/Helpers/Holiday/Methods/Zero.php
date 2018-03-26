<?php

namespace App\Helpers\Holiday\Methods;

class Zero extends Base
{

    /**
     * @return \DateTime
     */
    protected function getHolidayDate()
    {
        return new \DateTime();
    }

    /**
     * @return boolean
     */
    public function isHoliday()
    {
        return false;
    }
}
