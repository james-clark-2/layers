<?php

namespace App\Http\Controllers;

use App\Services\Contracts\WeatherForecastServiceInterface;
use Illuminate\Http\Request;

class HourlyForecastController extends Controller
{
    public function __construct(
        protected WeatherForecastServiceInterface $weatherService
    ) { }

    public function get(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|min:-180|max:180',
            'longitude' => 'required|numeric|min:-180|max:180',
            'units' => 'in:us,si'
        ]);

        return $this->weatherService->getHourlyForecastForLatLong(
            $request->get('latitude'),
            $request->get('longitude'),
            strtolower($request->get('units')) === 'us'
        );
    }
}
