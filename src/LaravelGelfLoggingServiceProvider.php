<?php

namespace LeandroSe\LaravelGelfLogging;

use Illuminate\Support\ServiceProvider;

class LaravelGelfLoggingServiceProvider extends ServiceProvider
{

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        // Register the service the package provides.
        $this->app->bind('laravelgelflogging', function () {
            return new LaravelGelfLogging;
        });
        // Publishing the configuration file.
        $config = config('logging.channels');
        $gelfConfig = include __DIR__ . '/../config/logging.php';
        app('config')->set('logging.channels', array_merge(
            $config,
            $gelfConfig['channels']
        ));
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravelgelflogging'];
    }
}
