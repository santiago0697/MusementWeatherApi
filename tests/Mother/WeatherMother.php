<?php

namespace Tests\Mother;

use Carbon\Carbon;
use DateTime;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Collection;
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

    public function getWeathers(int $days): array
    {
        return Collection::times($days)
            ->map(fn() => $this->get())
            ->toArray();
    }
}
