<?php

namespace MusementWeather\City\Domain\ValueObject;

class Coordinates
{
    public function __construct(private float $latitude, private float $longitude)
    {
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }
}
