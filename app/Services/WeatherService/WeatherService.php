<?php

declare(strict_types=1);

namespace App\Services\WeatherService;


use App\Contracts\WeatherProviderContract;
use App\Services\WeatherService\Entities\WeatherItem;
use App\Services\WeatherService\Providers\WeatherProviderFactory;
use Exception;


class WeatherService
{
    /**
     * Declaration default provider.
     *
     * @var string
     */
    private string $defaultProvider = 'weatherbit';

    /**
     * @var WeatherProviderContract
     */
    private WeatherProviderContract $provider;

    /**
     * Load default provider.
     */
    public function __construct()
    {
        $this->provider = $this->loadProvider($this->defaultProvider);
    }

    /**
     * Get weather info from all providers and count average temperature.
     *
     * @param string $city
     * @return array
     */
    public function getInfoByCity(string $city): array
    {
        $temperature = 0;
        $response = [];
        $providerList = array_keys(ProvidersList::PROVIDERS);
        foreach ($providerList as $providerName) {
            $this->loadProvider($providerName);

            try {
                $weatherItem = $this->retrieve(provider: $this->provider, city: $city);
            } catch (Exception $exception) {
                $response[$this->provider->getName()] = 'Provider does not available now';
                continue;
            }

            $temperature += intval($weatherItem->getTemperature());

            $response[$this->provider->getName()] = $weatherItem->getInfo();
            $response['averageTemperature'] = $temperature;
        }

        return $response;
    }

    /**
     * Get weather info by city from single provider.
     *
     * @param string $city
     * @return array
     */
    public function getSingleInfoByCity(string $city): array
    {
        $weatherItem = $this->retrieve(provider: $this->provider, city: $city);
        return $weatherItem->getInfo();
    }

    /**
     * @param WeatherProviderContract $provider
     * @param string $city
     * @return WeatherItem
     */
    private function retrieve(WeatherProviderContract $provider, string $city): WeatherItem
    {
        return $provider->getData($city);
    }

    /**
     * @param string $providerName
     * @return WeatherProviderContract
     * @throws Exceptions\ProviderNotFoundException
     */
    public function loadProvider(string $providerName): WeatherProviderContract
    {
        $this->provider = WeatherProviderFactory::create($providerName);

        return $this->provider;
    }
}
