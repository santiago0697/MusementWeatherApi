<?php

namespace Tests\Mother;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Collection;
use MusementWeather\City\Domain\ValueObject\Coordinates;
use MusementWeather\Shared\Domain\City;
use MusementWeather\Shared\Domain\ValueObject\CityName;

class CityMother
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create('ES_es');
    }

    public function get(CityName $cityName = null, Coordinates $coordinates = null): City
    {
        return new City(
            $cityName ?? new CityName($this->faker->city()),
            $coordinates ?? new Coordinates($this->faker->randomFloat(), $this->faker->randomFloat())
        );
    }

    /**
     * @return City[]
     */
    public function getMultipleCities(): array
    {
        return Collection::times($this->faker->numberBetween(5, 10))
            ->map(fn() => $this->get())
            ->toArray();
    }
}
