<?php

namespace LeandroSe\LaravelGelfLogging\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelGelfLogging extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravelgelflogging';
    }
}
