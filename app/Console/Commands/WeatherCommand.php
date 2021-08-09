<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MusementWeather\City\Application\CitiesService;
use MusementWeather\Weather\Application\CityWeatherService;
use MusementWeather\Weather\Domain\CityWeather;

class WeatherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check weather of the cities provided by the cites provider';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(private CitiesService $citiesService, private CityWeatherService $cityWeatherService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cities = $this->citiesService->getAll();
        $weathers = $this->cityWeatherService->getWeatherByCities($cities);

        collect($weathers)
            ->each(function (CityWeather $cityWeather) {
                echo "{$cityWeather->getCityName()} | {$cityWeather->getWeathersFormatted()}" . PHP_EOL;
            });

        return 0;
    }
}
