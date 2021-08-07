<?php

namespace MusementWeather\Domain;

interface CitiesProvider
{
    /**
     * @return City[]
     */
    public function all(): array;
}
