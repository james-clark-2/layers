<?php

namespace Tests\Integration\Http\Controllers;

use Tests\TestCase;
use Tests\Traits\ProvidesWeatherRequestParameters;

class HourlyForecastControllerTest extends TestCase
{
    use ProvidesWeatherRequestParameters;

    /**
     * @dataProvider good_params_provider
     */
    public function test_it_returns_an_ok_status($latitude, $longitude, $units)
    {
        $response = $this->get('/api/weather?'. http_build_query([
            'latitude' => $latitude,
            'longitude' => $longitude,
            'units' => $units
        ]));

        $response->assertOk();
    }

    /**
     * @dataProvider bad_params_provider
     */
    public function test_it_returns_a_422_status_for_bad_params($latitude, $longitude, $units, array $expectedFailedFields)
    {
        $response = $this->get('/api/weather?'. http_build_query([
            'latitude' => $latitude,
            'longitude' => $longitude,
            'units' => $units
        ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors($expectedFailedFields);
    }
}
