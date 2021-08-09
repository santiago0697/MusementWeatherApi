<?php

namespace MusementWeather\Weather\Infrastructure;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use MusementWeather\Shared\Domain\City;
use MusementWeather\Shared\Domain\ValueObject\CityName;
use MusementWeather\Weather\Domain\CityWeather;
use MusementWeather\Weather\Domain\Exception\CannotRetrieveWeather;
use MusementWeather\Weather\Domain\ValueObject\WatherDescription;
use MusementWeather\Weather\Domain\Weather;
use MusementWeather\Weather\Domain\WeatherProvider;

class WeatherApiProvider implements WeatherProvider
{
    /**
     * @inheritDoc
     * @throws CannotRetrieveWeather
     */
    public function getByCity(City $city): CityWeather
    {
        $apiKey = env('WEATHER_API_KEY') ?? throw new \Exception('Weather API Key not found');
        $weatherApiResponse = Http::get(
            env('WEATHER_BASE_URL') . '/v1/forecast.json',
            [
                'key' => $apiKey,
                'q' => (string)$city->getCoordinates(),
                'days' => env('WEATHER_MAX_DAYS_RETRIEVE')
            ]
        );
        $weatherApiResponse->onError(fn() => throw new CannotRetrieveWeather($city));
        $cityName = $weatherApiResponse->json('location')['name'];
        $forecasts = $weatherApiResponse->json('forecast')['forecastday'];
        $weathers = collect($forecasts)
            ->map(
                fn($forecast) => new Weather(
                    new WatherDescription($forecast['day']['condition']['text']),
                    new Carbon($forecast['date'])
                )
            )
            ->toArray();

        return new CityWeather(new CityName($cityName), $weathers);
    }
}
