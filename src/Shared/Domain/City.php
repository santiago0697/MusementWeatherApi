<?php

namespace MusementWeather\Shared\Domain;

use MusementWeather\City\Domain\ValueObject\Coordinates;
use MusementWeather\Shared\Domain\ValueObject\CityName;

class City
{
    /**
     * @param CityName $cityName
     * @param Coordinates $coordinates
     */
    public function __construct(private CityName $cityName, private Coordinates $coordinates)
    {
    }

    public function getName(): string
    {
        return $this->cityName->getName();
    }

    /**
     * @return Coordinates
     */
    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }
}
