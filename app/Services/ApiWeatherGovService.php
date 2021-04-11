<?php

namespace App\Services;

use App\Services\Contracts\WeatherForecastServiceInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

/**
 * Class ApiWeatherGovService
 * @package App\Services
 */
class ApiWeatherGovService implements WeatherForecastServiceInterface
{
    protected string $userAgent;

    public function __construct(
        protected string $url = 'https://api.weather.gov'
    ) {
        $this->userAgent = Config::get('api_weather_gov.user_agent');
    }

    public function getHourlyForecastForLatLong(float $latitude, float $longitude, bool $fahrenheit = true): array
    {
        //Query points endpoint for hourly forecast url based on forecast area that contains latitude, longitude
        $hourlyUrl = Http::withHeaders(['User-Agent' => $this->userAgent])
            ->get($this->url . '/' . $latitude . ',' . $longitude)
            ->json('properties.forecastHourly');

        //Query hourly endpoint for forecast
        return $hourlyUrl ?
            Http::withHeaders(['User-Agent' => $this->userAgent])
                ->get($hourlyUrl, ['units' => $fahrenheit ? 'us' : 'si'])
                ->json('properties.periods', []) :
            [];
    }
}
