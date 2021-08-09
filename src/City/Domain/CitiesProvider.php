<?php

namespace MusementWeather\City\Domain;

use MusementWeather\City\Domain\Exception\CannotRetrieveCities;
use MusementWeather\Shared\Domain\City;

interface CitiesProvider
{
    /**
     * @return City[]
     * @throws CannotRetrieveCities
     */
    public function all(): array;
}
