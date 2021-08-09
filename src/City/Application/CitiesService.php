<?php

namespace MusementWeather\City\Application;

use MusementWeather\City\Domain\CannotRetrieveCities;
use MusementWeather\City\Domain\CitiesProvider;
use MusementWeather\Shared\Domain\City;

class CitiesService
{
    public function __construct(private CitiesProvider $citiesProvider)
    {
    }

    /**
     * @return City[]
     * @throws CannotRetrieveCities
     */
    public function getAll(): array
    {
        return $this->citiesProvider->all();
    }
}
