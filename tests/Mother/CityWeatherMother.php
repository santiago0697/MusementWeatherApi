<?php

namespace Tests\Mother;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Collection;
use MusementWeather\Shared\Domain\ValueObject\CityName;
use MusementWeather\Weather\Domain\CityWeather;
use MusementWeather\Weather\Domain\Weather;

class CityWeatherMother
{
    private Generator $faker;
    private WeatherMother $weatherMother;

    public function __construct()
    {
        $this->faker = Factory::create('ES_es');
        $this->weatherMother = new WeatherMother();
    }

    /**
     * @param CityName|null $cityName
     * @param Weather[]|null $weathers
     * @return CityWeather
     */
    public function get(CityName $cityName = null, array $weathers = null): CityWeather
    {
        $weathers = $weathers ?? $this->weatherMother->getWeathers(env('WEATHER_MAX_DAYS_RETRIEVE'));

        return new CityWeather(
            $cityName ?? new CityName($this->faker->city()),
            $weathers
        );
    }
}
