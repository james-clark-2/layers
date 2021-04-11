<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\HourlyForecastController;
use App\Services\Contracts\WeatherForecastServiceInterface;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Tests\Traits\ProvidesWeatherRequestParameters;

class HourlyForecastControllerTest extends TestCase
{
    use ProvidesWeatherRequestParameters;

    /**
     * @dataProvider good_params_provider
     */
    public function test_it_returns_a_list_of_forecasts($latitude, $longitude, $units)
    {
        $expectedResult = [['foo'], ['bar']];

        $mockWeatherService = \Mockery::mock(WeatherForecastServiceInterface::class)
            ->shouldReceive('getHourlyForecastForLatLong')
            ->andReturn($expectedResult)
            ->getMock();

        $controller = app()->make(HourlyForecastController::class, ['weatherService' => $mockWeatherService]);

        $request = app('request')->merge([
            'latitude' => $latitude,
            'longitude' => $longitude,
            'units' => $units
        ]);

        $result = $controller->get($request);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider bad_params_provider
     */
    public function test_it_rejects_invalid_params($latitude, $longitude, $units)
    {
        $mockWeatherService = \Mockery::mock(WeatherForecastServiceInterface::class)
            ->shouldNotReceive('getHourlyForecastForLatLong')
            ->getMock();

        $controller = app()->make(HourlyForecastController::class, ['weatherService' => $mockWeatherService]);

        $request = app('request')->merge([
            'latitude' => $latitude,
            'longitude' => $longitude,
            'units' => $units
        ]);

        $this->expectException(ValidationException::class);

        $controller->get($request);
    }
}
