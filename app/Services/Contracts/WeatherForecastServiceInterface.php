<?php

namespace App\Services\Contracts;

/**
 * Interface WeatherForecastServiceInterface
 * @package App\Services\Contracts
 */
interface WeatherForecastServiceInterface
{
    public function getHourlyForecastForLatLong(float $latitude, float $longitude, bool $fahrenheit = true): array;
}
