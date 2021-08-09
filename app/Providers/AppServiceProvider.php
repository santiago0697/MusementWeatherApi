<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MusementWeather\City\Domain\CitiesProvider;
use MusementWeather\City\Infrastructure\MusementApiCityProvider;
use MusementWeather\Weather\Domain\WeatherProvider;
use MusementWeather\Weather\Infrastructure\WeatherApiProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CitiesProvider::class, MusementApiCityProvider::class);
        $this->app->bind(WeatherProvider::class, WeatherApiProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
