<?php

namespace Tests\Unit\Services;

use App\Services\WeatherbitIoService;
use App\Services\ApiWeatherGovService;
use Tests\TestCase;

/**
 * Class ApiWeatherGovService
 * @package Services
 */
class ApiWeatherGovService extends TestCase
{
    public function test_it_does_something()
    {
        /** @var ApiWeatherGovService $service */
        $service = app(ApiWeatherGovService::class);

        $result = $service->getHourlyForecastForLatLong(0, 0);

        $a=1;
    }
}

