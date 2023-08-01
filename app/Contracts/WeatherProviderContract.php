<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Services\WeatherService\Entities\WeatherItem;

interface WeatherProviderContract
{
    public function getData(string $city): WeatherItem;
}
