<?php

namespace MusementWeather\City\Domain;

use MusementWeather\Shared\Domain\City;

interface CitiesProvider
{
    /**
     * @throws CannotRetrieveCities
     * @return City[]
     */
    public function all(): array;
}
