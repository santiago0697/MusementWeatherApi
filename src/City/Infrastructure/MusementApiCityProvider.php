<?php

namespace MusementWeather\City\Infrastructure;

use Illuminate\Support\Facades\Http;
use MusementWeather\City\Domain\CitiesProvider;
use MusementWeather\City\Domain\ValueObject\Coordinates;
use MusementWeather\Shared\Domain\ValueObject\CityName;
use MusementWeather\Shared\Domain\City;

class MusementApiCityProvider implements CitiesProvider
{
    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $apiResponse = Http::withHeaders(
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        )->get('https://api.musement.com/api/v3/cities');

        return collect($apiResponse->json())
            ->map(
                fn(array $city) => new City(
                    new CityName($city['name']),
                    new Coordinates($city['latitude'], $city['longitude'])
                )
            )
            ->toArray();
    }
}
