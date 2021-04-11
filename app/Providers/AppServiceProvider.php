<?php

namespace App\Providers;

use App\Http\Controllers\HourlyForecastController;
use App\Services\ApiWeatherGovService;
use App\Services\Contracts\WeatherForecastServiceInterface;
use App\Services\WeatherbitIoService;
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
            ->needs(WeatherForecastServiceInterface::class)
            ->give(ApiWeatherGovService::class);
    }
}
