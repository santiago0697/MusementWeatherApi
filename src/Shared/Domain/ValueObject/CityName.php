<?php

namespace MusementWeather\Shared\Domain\ValueObject;

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
