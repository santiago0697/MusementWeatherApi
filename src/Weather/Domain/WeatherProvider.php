<?php

namespace MusementWeather\Weather\Domain;

use MusementWeather\Shared\Domain\City;
use MusementWeather\Weather\Domain\Exception\CannotRetrieveWeather;

interface WeatherProvider
{
    /**
     * @param City $city
     * @return CityWeather
     * @throws CannotRetrieveWeather
     */
    public function getByCity(City $city): CityWeather;
}
