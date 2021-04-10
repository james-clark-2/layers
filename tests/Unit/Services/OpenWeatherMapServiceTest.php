<?php

namespace Services;

use App\Services\OpenWeatherMapService;
use Tests\TestCase;

/**
 * Class OpenWeatherMapServiceTest
 * @package Services
 */
class OpenWeatherMapServiceTest extends TestCase
{
    public function test_it_does_something()
    {
        /** @var OpenWeatherMapService $service */
        $service = app(OpenWeatherMapService::class);

        $result = $service->getHourlyForecast('foo', 'bar', 'US');
    }
}
