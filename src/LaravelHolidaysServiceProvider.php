<?php

namespace SimonBarrettACT\LaravelHolidays;

use Carbon\Carbon;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasConfigFile();

        /** @noinspection PhpUnhandledExceptionInspection */
        Carbon::mixin(new LaravelHolidays);

    }
}
