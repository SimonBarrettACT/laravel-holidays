<?php

namespace SimonBarrettACT\LaravelHolidays;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use SimonBarrettACT\LaravelHolidays\Commands\LaravelHolidaysCommand;

class LaravelHolidaysServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-holidays')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-holidays_table')
            ->hasCommand(LaravelHolidaysCommand::class);
    }
}