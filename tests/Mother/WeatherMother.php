<?php

namespace Tests\Mother;

use Carbon\Carbon;
use DateTime;
use Faker\Factory;
use Faker\Generator;
use MusementWeather\Weather\Domain\ValueObject\WatherDescription;
use MusementWeather\Weather\Domain\Weather;

class WeatherMother
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('ES_es');
    }

    public function get(WatherDescription $weatherDescription = null, DateTime $dateTime = null): Weather
    {
        return new Weather(
            $weatherDescription ?? new WatherDescription($this->faker->slug(2)),
            $dateTime ?? Carbon::now()->startOfDay()
        );
    }
}
