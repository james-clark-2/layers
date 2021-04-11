<?php

namespace Tests\Unit\Services;

use App\Services\ApiWeatherGovService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * Class ApiWeatherGovService
 * @package Services
 */
class ApiWeatherGovServiceTest extends TestCase
{
    public function test_it_returns_forecast_periods()
    {
        Http::fake([
            'api.weather.gov/*' => Http::sequence()
                ->push($this->getJsonFixture('weather.gov/points_result.json'))
                ->push($periodResponse = $this->getJsonFixture('weather.gov/hourly_forecast.json'))
        ]);

        $result = app(ApiWeatherGovService::class)->getHourlyForecastForLatLong(0, 0);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertEquals(Arr::get(json_decode($periodResponse, true), 'properties.periods'), $result);
    }

    public function test_it_returns_no_forecast_periods_for_invalid_lat_long()
    {
        Http::fake([
            'api.weather.gov/*' => Http::sequence()
                ->push($this->getJsonFixture('weather.gov/invalid_points_result.json'), 404)
                ->push($this->getJsonFixture('weather.gov/hourly_forecast.json'))
        ]);

        $result = app(ApiWeatherGovService::class)->getHourlyForecastForLatLong(0, 0);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function test_it_returns_no_forecast_periods_for_invalid_units()
    {
        Http::fake([
            'api.weather.gov/*' => Http::sequence()
                ->push($this->getJsonFixture('weather.gov/points_result.json'), 404)
                ->push($this->getJsonFixture('weather.gov/hourly_forecast_invalid_units.json'))
        ]);

        $result = app(ApiWeatherGovService::class)->getHourlyForecastForLatLong(0, 0);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }
}

