<?php

namespace MusementWeather\Weather\Domain;

use MusementWeather\Shared\Domain\ValueObject\CityName;

class CityWeather
{
    /**
     * @param CityName $cityName
     * @param Weather[] $weathers
     */
    public function __construct(private CityName $cityName, private array $weathers)
    {
    }

    /**
     * @return CityName
     */
    public function getCityName(): CityName
    {
        return $this->cityName;
    }

    /**
     * @return Weather[]
     */
    public function getWeathers(): array
    {
        return $this->weathers;
    }
}
