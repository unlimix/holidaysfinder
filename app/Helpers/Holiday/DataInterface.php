<?php

namespace App\Helpers\Holiday;

interface DataInterface
{
    public function getTitle();
    public function getType();
    public function getDateFrom();
    public function getDateTo();
    public function getMonth();
    public function getWeek();
    public function getDay();
    public function getIsCheckMonday();
}
