<?php

declare(strict_types=1);

namespace App\Services\WeatherService\Providers;


use App\Contracts\WeatherProviderContract;
use App\Services\WeatherService\Entities\WeatherItem;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;


class Weatherbit implements WeatherProviderContract
{
    /**
     * @param array $configs
     */
    public function __construct(private readonly array $configs)
    {
    }

    /**
     * Provider name.
     *
     * @var string
     */
    private string $name = 'Weatherbit';

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
        $response = Http::get($this->configs['api_url'], http_build_query([
            'key' => $this->configs['api_key'],
            'city' => $city
        ]));

        if ($response->status() != Response::HTTP_OK) {
            $response->throw();
        }

        $responseBody = json_decode($response->body(), true);

        $weatherItem = new WeatherItem();
        $weatherItem->setTemperature(intval($responseBody['data'][0]['temp']));

        return $weatherItem;
    }
}
