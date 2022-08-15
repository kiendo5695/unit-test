<?php

namespace App\Services;

use Carbon\Carbon;

class AtmService
{
    private $dateTime;
    private $isVipCustomer;

    public function __construct($dateTime, $isVipCustomer = false)
    {
        $this->dateTime = $dateTime;
        $this->isVipCustomer = $isVipCustomer;
    }

    public function getFee(): int
    {
        $dateTime = Carbon::parse($this->dateTime);
        $time = $dateTime->copy()->format('H:i:s');
        if ($this->isVipCustomer) {
            return 0;
        }
        if (
            $dateTime->isWeekend() ||
            $this->isHoliday($dateTime) ||
            ($time >= '00:00:00' && $time <= '08:44:59') ||
            ($time >= '18:00:00' && $time <= '23:59:59')
        ) {
            return 110;
        } else {
            return 0;
        }
    }

    public function isHoliday($dateTime): bool
    {
        $holidays = ['2022-07-15', '2022-07-18', '2022-07-19'];
        if (in_array($dateTime->copy()->format('Y-m-d'), $holidays)) {
            return true;
        }
        return false;
    }
}
