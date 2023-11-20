<?php

namespace SimonBarrettACT\LaravelHolidays;

use Carbon\Carbon;

class LaravelHolidays
{
    private function getDate($date): LaravelHolidays|Carbon|static
    {
        if (is_string($date) || is_numeric($date)) {
            return Carbon::parse(strlen($date) > 4 ? $date : "{$date}-01-01");
        } else {
            return $date instanceof \Carbon\Carbon ? $date : $this;
        }
    }

    public function isHoliday(): \Closure
    {

        return function () {
            /** @var Carbon $this */
            $year = $this->year;

            $newYear = Carbon::createFromDate($year, 01, 01);
            $easter = Carbon::createFromDate($year, 03, 21)->addDays(easter_days($year));
            $goodFriday = $easter->clone()->subDays(2);
            $christmas = Carbon::createFromDate($year, 12, 25);

            // New Year's Day
            if ($this->isSameDay($newYear)) {
                return true;
            }

            // Good Friday
            if ($this->isSameDay($goodFriday)) {
                return true;
            }

            // Easter Sunday
            if ($this->isSameDay($easter)) {
                return true;
            }

            // Easter Monday
            if ($this->isSameDay($easter->clone()->addDay())) {
                return true;
            }

            // 'Christmas Day
            if ($this->isSameDay($christmas)) {
                return true;
            }

            // Boxing Day
            if ($this->isSameDay($christmas->clone()->addDay())) {
                return true;
            }

            return false;
        };
    }

    public function newYearBankHoliday($year = null)
    {
        $date = $this->getDate($year);
        $year = $date->year;

        // New Year's Bank Holiday
        $newYearBankHoliday = Carbon::createFromDate($year, 01, 01);
        $newYearBankHolidayDay = $newYearBankHoliday->dayOfWeek;

        return match ($newYearBankHolidayDay) {
            0 => $newYearBankHoliday->addDay(),
            6 => $newYearBankHoliday->addDays(2),
            default => $newYearBankHoliday
        };
    }

    public function earlyMayBankHoliday($year = null)
    {
        $date = $this->getDate($year);
        $year = $date->year;

        // Early May Bank Holiday
        if (in_array($year, [1995, 2020])) {
            // Victory in Europe day
            return Carbon::createFromDate($year, 5, 8);
        } else {
            $earlyMayBankHoliday = Carbon::createFromDate($year, 05, 01);
            $earlyMayBankHolidayDay = $earlyMayBankHoliday->dayOfWeek;

            return match ($earlyMayBankHolidayDay) {
                0 => $earlyMayBankHoliday->addDay(),
                1 => $earlyMayBankHoliday,
                2 => $earlyMayBankHoliday->addDays(6),
                3 => $earlyMayBankHoliday->addDays(5),
                4 => $earlyMayBankHoliday->addDays(4),
                5 => $earlyMayBankHoliday->addDays(3),
                6 => $earlyMayBankHoliday->addDays(2),
            };
        }
    }

    public function isBankHoliday(): \Closure
    {
        return function () {

            $date = $this->getDate($this);

            // New Year's Bank Holiday
            if ($date->isSameDay($this->newYearBankHoliday())) {
                return true;
            }

            // Early May Bank Holiday
            if ($date->isSameDay($this->earlyMayBankHoliday())) {
                return true;
            }

            return false;
        };
    }
}
