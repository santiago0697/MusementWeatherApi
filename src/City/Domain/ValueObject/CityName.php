<?php

namespace MusementWeather\City\Domain\ValueObject;

class CityName
{
    public function __construct(private string $cityName)
    {
    }

    public function getName(): string
    {
        return $this->cityName;
    }
}
