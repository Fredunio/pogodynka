<?php 

namespace App\Service;

use App\Repository\MeasurementRepository;
use App\Repository\LocationRepository;
use App\Entity\Location;

class WeatherUtil 
{
    private LocationRepository $locationRepository ;
    private MeasurementRepository $measurementRepository;

    public function __construct(LocationRepository $locationRepository, MeasurementRepository $measurementRepository)
    {
        $this->locationRepository= $locationRepository;
        $this->measurementRepository= $measurementRepository;
    }

    public function getWeatherForCountryAndCity($countryCode, $cityName): string
    {
       $location = $this->locationRepository->findLocation($countryCode, $cityName);
       $measurements = $this->measurementRepository->findByLocation($location);
        return $measurements;
    }
    public function getWeatherForLocation(Location $location): string
    {
        $measurements = $this->measurementRepository->findByLocation($location);
        return $measurements;
    }
}