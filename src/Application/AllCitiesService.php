<?php

namespace MusementWeather\Application;

use MusementWeather\Domain\CitiesProvider;
use MusementWeather\Domain\City;

class AllCitiesService
{
    public function __construct(private CitiesProvider $citiesProvider)
    {
    }

    /**
     * @return City[]
     */
    public function get(): array
    {
        return $this->citiesProvider->all();
    }
}
