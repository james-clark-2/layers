<?php

namespace App\Http\Controllers;

use App\Services\Contracts\WeatherLookupServiceInterface;
use Illuminate\Http\Request;

class HourlyForecastController extends Controller
{
    public function __construct(
        protected WeatherLookupServiceInterface $weatherService
    ) { }

    public function get(Request $request, string $cityName, string $stateCode, string $countryCode)
    {
        $request->validate([
            'cityName' => 'required|string',
            'countryCode' => 'required|string',
            'stateCode' => 'required|string'
        ]);

        return $this->weatherService->getHourlyForecast($cityName, $stateCode, $countryCode);
    }
}
