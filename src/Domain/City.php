<?php

namespace MusementWeather\Domain;

use MusementWeather\Domain\ValueObject\CityName;

class City
{
    /**
     * @param CityName $cityName
     */
    public function __construct(private CityName $cityName)
    {
    }

    public function getName(): string
    {
        return $this->cityName->getName();
    }
}
