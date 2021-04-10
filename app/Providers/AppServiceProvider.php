<?php

namespace App\Providers;

use App\Http\Controllers\HourlyForecastController;
use App\Services\Contracts\WeatherLookupServiceInterface;
use App\Services\OpenWeatherMapService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->when(HourlyForecastController::class)
            ->needs(WeatherLookupServiceInterface::class)
            ->give(OpenWeatherMapService::class);
    }
}
