<?php

declare(strict_types=1);


namespace App\Services\WeatherService\Entities;


class WeatherItem
{
    /**
     * @var int|string
     */
    private int|string $temperature;

    /**
     * @var string
     */
    private string $wind = 'Not info';

    /**
     * @var array
     */
    private array $forecast = [];

    /**
     * @return string
     */
    public function getWind(): string
    {
        return $this->wind;
    }

    /**
     * @param string $wind
     * @return void
     */
    public function setWind(string $wind): void
    {
        $this->wind = $wind;
    }

    /**
     * @return array
     */
    public function getForecast(): array
    {
        return $this->forecast;
    }

    /**
     * @param array $forecast
     * @return void
     */
    public function setForecast(array $forecast): void
    {
        $this->forecast = $forecast;
    }

    /**
     * @return int
     */
    public function getTemperature(): int|string
    {
        return $this->temperature;
    }

    /**
     * @param int $temperature
     */
    public function setTemperature(int|string $temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * Serialize data.
     *
     * @return array
     */
    public function getInfo(): array
    {
        return [
            'temperature'   => $this->getTemperature(),
            'wind'          => $this->getWind(),
            'forecast'      => $this->getForecast()
        ];
    }
}
