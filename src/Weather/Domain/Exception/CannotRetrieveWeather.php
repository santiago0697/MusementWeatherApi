<?php

namespace MusementWeather\Weather\Domain\Exception;

use Exception;
use MusementWeather\Shared\Domain\City;

class CannotRetrieveWeather extends Exception
{
   public function __construct(City $city)
   {
       parent::__construct("Cannot retrieve weather from city: {$city->getName()}({$city->getCoordinates()})");
   }
}
