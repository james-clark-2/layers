<?php

namespace App\Services;

use App\Services\Contracts\WeatherLookupServiceInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

/**
 * Class WeatherLookupService
 * @package App\Services
 */
class OpenWeatherMapService implements WeatherLookupServiceInterface
{
    protected string $url;
    protected string $apiVersion;
    protected string $apiKey;

    public function __construct()
    {
        $this->url = Config::get('openweather.url');
        $this->apiVersion = Config::get('openweather.api_version');
        $this->apiKey = Config::get('openweather.api_key');
    }

    public function getHourlyForecast(string $cityName, string $stateCode, string $countryCode)
    {
        $params = [
            'q' => implode(',', [$cityName, $stateCode, $countryCode]),
            'appid' => Config::get('openweather.api_key')
        ];

        return Http::get($this->hourlyForecastUrl(), $params);
    }

    private function hourlyForecastUrl(): string
    {
        return implode('/', [$this->url, $this->apiVersion, 'hourly']);
    }
}
