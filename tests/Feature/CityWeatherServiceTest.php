<?php

namespace Tests\Feature;

use Mockery\MockInterface;
use MusementWeather\Shared\Domain\City;
use MusementWeather\Shared\Domain\ValueObject\CityName;
use MusementWeather\Weather\Application\CityWeatherService;
use MusementWeather\Weather\Domain\CityWeather;
use MusementWeather\Weather\Domain\WeatherProvider;
use Tests\Mother\CityMother;
use Tests\Mother\CityWeatherMother;
use Tests\TestCase;

class CityWeatherServiceTest extends TestCase
{

    private CityMother $cityMother;
    private CityWeatherMother $cityWeatherMother;

    public function __construct()
    {
        parent::__construct();
        $this->cityMother = new CityMother();
        $this->cityWeatherMother = new CityWeatherMother();
    }

    /**
     * @test
     * @return void
     */
    public function returns_weather_correctly()
    {
        $city = $this->cityMother->get();
        $cityWeather = $this->cityWeatherMother->get(new CityName($city->getName()));

        $this->mock(
            WeatherProvider::class,
            function (MockInterface $mock) use ($cityWeather) {
                $mock->shouldReceive('getByCity')
                    ->andReturns($cityWeather);
            }
        );

        $service = resolve(CityWeatherService::class);
        $result = $service->getWeatherByCities([$city]);

        $this->assertEqualsCanonicalizing([$cityWeather], $result);
    }
}
