<?php

namespace Tests\Feature;

use Mockery\MockInterface;
use MusementWeather\City\Application\CitiesService;
use MusementWeather\City\Domain\CitiesProvider;
use MusementWeather\City\Domain\Exception\CannotRetrieveCities;
use Tests\Mother\CityMother;
use Tests\TestCase;

class CitiesServicesTest extends TestCase
{
    private CityMother $cityMother;

    public function __construct()
    {
        parent::__construct();
        $this->cityMother = new CityMother();
    }

    /**
     * @test
     */
    public function returns_cities_correctly()
    {
        $expectedCities = $this->cityMother->getMultipleCities();

        $this->mock(CitiesProvider::class, function (MockInterface $mock) use ($expectedCities) {
            $mock->shouldReceive('all')
                ->andReturns($expectedCities);
        });

        $service = resolve(CitiesService::class);
        $cities = $service->getAll();

        $this->assertEqualsCanonicalizing($expectedCities, $cities);
    }

    /**
     * @test
     */
    public function throws_exception_when_cannot_retrieve_cities()
    {
        $this->mock(CitiesProvider::class, function (MockInterface $mock) {
            $mock->shouldReceive('all')
                ->andThrow(CannotRetrieveCities::class);
        });

        $service = resolve(CitiesService::class);
        $this->expectException(CannotRetrieveCities::class);
        $service->getAll();
    }
}
