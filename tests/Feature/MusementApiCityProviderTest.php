<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use MusementWeather\City\Domain\Exception\CannotRetrieveCities;
use MusementWeather\City\Infrastructure\MusementApiCityProvider;
use MusementWeather\Shared\Domain\City;
use Tests\Mother\CityMother;
use Tests\TestCase;

class MusementApiCityProviderTest extends TestCase
{
    private CityMother $cityMother;

    public function __construct()
    {
        parent::__construct();
        $this->cityMother = new CityMother();
    }

    /**
     * @test
     * @return void
     */
    public function musement_api_response_correctly()
    {
        $expectedCities = $this->cityMother->getMultipleCities();

        Http::fake(
            [
                '*' => Http::response($this->parseCitiesToJson($expectedCities))
            ]
        );

        $musementApiCityProvider = new MusementApiCityProvider();
        $cities = $musementApiCityProvider->all();

        $this->assertEqualsCanonicalizing($expectedCities, $cities);
    }

    private function parseCitiesToJson(array $cities): string
    {
        $cities = collect($cities)
            ->map(fn(City $city) => [
                'name' => $city->getName(),
                'latitude' => $city->getCoordinates()->getLatitude(),
                'longitude' => $city->getCoordinates()->getLongitude()
            ])
            ->toArray();
        return json_encode($cities);
    }

    /**
     * @test
     */
    public function musent_api_error_response()
    {
        Http::fake(
            [
                '*' => Http::response('', 500)
            ]
        );

        $this->expectException(CannotRetrieveCities::class);

        $musementApiCityProvider = new MusementApiCityProvider();
        $musementApiCityProvider->all();
    }
}
