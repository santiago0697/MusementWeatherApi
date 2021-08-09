<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use MusementWeather\Shared\Domain\City;
use MusementWeather\Weather\Domain\Weather;
use MusementWeather\Weather\Infrastructure\WeatherApiProvider;
use Tests\Mother\CityMother;
use Tests\Mother\WeatherMother;
use Tests\TestCase;

class WeatherApiProviderTest extends TestCase
{
    use WithFaker;

    private CityMother $cityMother;
    private WeatherMother $weatherMother;

    public function __construct()
    {
        parent::__construct();
        $this->cityMother = new CityMother();
        $this->weatherMother = new WeatherMother();
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function weather_api_response_correctly()
    {
        $city = $this->cityMother->get();
        $weathers = Collection::times(env('WEATHER_MAX_DAYS_RETRIEVE'))
            ->map(fn() => $this->weatherMother->get())
            ->toArray();

        Http::fake(
            [
                '*' => Http::response($this->getWeatherApiResponse($city, $weathers))
            ]
        );
        $weatherApiProvider = new WeatherApiProvider();
        $cityWeather = $weatherApiProvider->getByCity($city);
        $this->assertEquals($city->getName(), $cityWeather->getCityName());
        $this->assertEqualsCanonicalizing($weathers, $cityWeather->getWeathers());
    }

    private function getWeatherApiResponse(City $city, array $weathers)
    {
        return json_encode(
            [
                'location' => [
                    'name' => $city->getName()
                ],
                'forecast' => [
                    'forecastday' => $this->getWeatherResponse($weathers)
                ]
            ]
        );
    }

    private function getWeatherResponse(array $weathers): array
    {
        return collect($weathers)
            ->map(fn(Weather $weather) => [
                'day' => [
                    'condition' => [
                        'text' => $weather->getDescription()
                    ]
                ],
                'date' => $weather->getDateTime()->format('Y-m-d')
            ])
            ->toArray();
    }
}
