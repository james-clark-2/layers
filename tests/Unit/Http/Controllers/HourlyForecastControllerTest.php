<?php

namespace Tests\Integration\Http\Controllers;

use Tests\TestCase;

class HourlyForecastControllerTest extends TestCase
{
    public function test_it_returns_an_ok_status()
    {
        $this->get('/api/weather/us/30,-80')
            ->assertOk();
    }
}
