<?php

namespace Tests\Traits;

/**
 * Trait ProvidesWeatherRequestParameters
 * @package Tests\Traits
 */
trait ProvidesWeatherRequestParameters
{
    public function good_params_provider()
    {
        return [
            [0, 0, 'us'],
            [0, 0, 'si'],
            [100, -100, 'us'],
            ['100.0', '-100.0', 'us'],
            ['100.0', '-100.0', 'si']
        ];
    }

    public function bad_params_provider()
    {
        return [
            ['abc', 0, 'us', ['latitude']],
            [0, 'abc', 'us', ['longitude']],
            ['abc', 'abc', 'us', ['latitude', 'longitude']],
            ['123abc', '123abc', 'us', ['latitude', 'longitude']],
            [0, 0, 'not a valid unit', ['units']],
            ['abc', 'abc', 'not a valid unit', ['latitude', 'longitude', 'units']]
        ];
    }
}
