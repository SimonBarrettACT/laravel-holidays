<?php

namespace SimonBarrettACT\LaravelHolidays\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SimonBarrettACT\LaravelHolidays\LaravelHolidays
 */
class LaravelHolidays extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \SimonBarrettACT\LaravelHolidays\LaravelHolidays::class;
    }
}
