<?php

namespace App\Services\Contracts;

/**
 * Interface WeatherLookupServiceInterface
 * @package App\Services\Contracts
 */
interface WeatherLookupServiceInterface
{
    public function getHourlyForecast(string $cityName, string $stateCode, string $countryCode);
}
