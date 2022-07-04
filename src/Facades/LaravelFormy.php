<?php

namespace Visanduma\LaravelFormy\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Visanduma\LaravelFormy\LaravelFormy
 */
class LaravelFormy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-formy';
    }
}
