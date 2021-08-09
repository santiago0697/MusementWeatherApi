<?php

namespace MusementWeather\Weather\Domain;

use MusementWeather\Shared\Domain\City;

interface WeatherProvider
{
    /**
     * @param City $city
     * @return CityWeather
     */
    public function getByCity(City $city): CityWeather;
}
