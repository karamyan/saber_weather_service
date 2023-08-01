<?php

declare(strict_types=1);

namespace App\Services\WeatherService\Providers;


use App\Contracts\WeatherProviderContract;
use App\Services\WeatherService\Entities\WeatherItem;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;


class Goweather implements WeatherProviderContract
{
    public function __construct(private readonly array $configs)
    {
    }

    /**
     * Provider name.
     *
     * @var string
     */
    private string $name = 'Goweather';

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Make request to provider and get info.
     *
     * @param string $city
     * @return WeatherItem
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getData(string $city): WeatherItem
    {
        $response = Http::get($this->configs['api_url'] . '/' . $city);

        if ($response->status() != Response::HTTP_OK) {
            $response->throw();
        }

        $responseBody = json_decode($response->body(), true);

        $weatherItem = new WeatherItem();
        $weatherItem->setTemperature($responseBody['temperature']);
        $weatherItem->setWind($responseBody['wind']);
        $weatherItem->setForecast($responseBody['forecast']);

        return $weatherItem;
    }
}
