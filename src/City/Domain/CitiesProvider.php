<?php

namespace MusementWeather\City\Domain;

use MusementWeather\Shared\Domain\City;

interface CitiesProvider
{
    /**
     * @return City[]
     */
    public function all(): array;
}
