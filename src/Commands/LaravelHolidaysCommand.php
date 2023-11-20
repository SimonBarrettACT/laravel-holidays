<?php

namespace SimonBarrettACT\LaravelHolidays\Commands;

use Illuminate\Console\Command;

class LaravelHolidaysCommand extends Command
{
    public $signature = 'laravel-holidays';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
