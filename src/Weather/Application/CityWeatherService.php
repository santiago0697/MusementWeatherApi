<?php

namespace MusementWeather\Weather\Application;

use MusementWeather\Shared\Domain\City;
use MusementWeather\Weather\Domain\CityWeather;
use MusementWeather\Weather\Domain\WeatherProvider;

class CityWeatherService
{
    public function __construct(private WeatherProvider $weatherProvider)
    {
    }

    /**
     * @param City[] $cities
     * @return CityWeather[]
     */
    public function getWeatherByCities(array $cities): array
    {
        return collect($cities)
            ->map(fn(City $city) => $this->weatherProvider->getByCity($city))
            ->toArray();
    }
}
