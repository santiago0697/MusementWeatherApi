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
     * @return WatherDescription
     */
    public function getDescription(): WatherDescription
    {
        return $this->description;
    }

    /**
     * @return DateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }
}
