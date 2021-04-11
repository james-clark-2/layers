<?php

namespace App\Services;

use App\Services\Contracts\WeatherForecastServiceInterface;
use Illuminate\Support\Facades\Http;

/**
 * Class ApiWeatherGovService
 * @package App\Services
 */
class ApiWeatherGovService implements WeatherForecastServiceInterface
{
    public function __construct(
        protected string $url = 'https://api.weather.gov'
    ) { }

    public function getHourlyForecastForLatLong(float $latitude, float $longitude, bool $fahrenheit = true): array
    {
        //Query points endpoint for hourly forecast url based on forecast area that contains latitude, longitude
        $hourlyUrl = Http::withHeaders(['User-agent' => 'Test'])
            ->get($this->url . '/' . ($latitude % 180).','.($longitude % 180))
            ->json('properties.forecastHourly');

        //Query hourly endpoint for forecast
        return $hourlyUrl ?
            Http::withHeaders(['User-agent' => 'Test'])
                ->get($hourlyUrl, ['units' => $fahrenheit ? 'us' : 'si'])
                ->json('properties.periods', []) :
            [];
    }
}
