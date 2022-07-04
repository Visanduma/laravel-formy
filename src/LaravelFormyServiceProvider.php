<?php

namespace Visanduma\LaravelFormy;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Visanduma\LaravelFormy\Commands\LaravelFormyCommand;

class LaravelFormyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-formy')
            ->hasConfigFile()
            ->hasViews('formy')
            ->hasMigration('create_laravel-formy_table')
            ->hasCommand(LaravelFormyCommand::class);
    }
}
