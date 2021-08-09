<?php

namespace MusementWeather\Weather\Domain\ValueObject;

class WatherDescription
{
    public function __construct(private string $weatherDescription)
    {
    }

    /**
     * @return string
     */
    public function getWeatherDescription(): string
    {
        return $this->weatherDescription;
    }
}
