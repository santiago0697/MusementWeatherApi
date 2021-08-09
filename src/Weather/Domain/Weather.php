<?php

namespace MusementWeather\Weather\Domain;

use DateTime;
use MusementWeather\Weather\Domain\ValueObject\WatherDescription;

class Weather
{
    public function __construct(private WatherDescription $description, private DateTime $dateTime)
    {
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description->getWeatherDescription();
    }

    /**
     * @return DateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }
}
