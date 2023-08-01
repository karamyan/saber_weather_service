<?php

namespace App\Providers;

use App\Services\WeatherService\WeatherService;
use Illuminate\Support\ServiceProvider;


class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->alias(WeatherService::class, 'weather_service');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
