<?php

declare(strict_types=1);

namespace App\Services\WeatherService\Providers;


use App\Contracts\WeatherProviderContract;
use App\Services\WeatherService\Exceptions\ProviderNotFoundException;


class WeatherProviderFactory
{
    /**
     * Make provider class with WeatherProviderContract intance.
     *
     * @throws ProviderNotFoundException
     */
    public static function create($key): WeatherProviderContract
    {
        $className = 'App\Services\WeatherService\Providers\\' . ucfirst($key);

        if (!class_exists($className)) {
            throw  new ProviderNotFoundException('Provider dont found');
        }

        $config = config('weather-providers.' . $key);

        return new $className($config);
    }
}
