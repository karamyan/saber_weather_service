<?php

declare(strict_types=1);

namespace App\Services\WeatherService;


use App\Services\WeatherService\Providers\Goweather;
use App\Services\WeatherService\Providers\Weatherbit;


final class ProvidersList
{
    /**
     * Weather Providers list.
     */
    public const PROVIDERS = [
        'weatherbit' => Weatherbit::class,
        'goweather'  => Goweather::class
    ];
}
