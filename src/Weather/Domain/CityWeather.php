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
     * @return string
     */
    public function getCityName(): string
    {
        return $this->cityName->getName();
    }

    /**
     * @return Weather[]
     */
    public function getWeathers(): array
    {
        return $this->weathers;
    }

    public function getWeathersFormatted(): string
    {
        return collect($this->weathers)
            ->map(fn(Weather $weather) => $weather->getDescription())
            ->join(' - ');
    }
}
