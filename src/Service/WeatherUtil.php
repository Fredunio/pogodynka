<?php 

namespace App\Service;

use App\Repository\MeasurementRepository;
use App\Repository\LocationRepository;
use App\Entity\Location;

class WeatherUtil 
{
    public function getWeatherForCountryAndCity($countryCode, $cityName, LocationRepository $locationRepository, MeasurementRepository $measurementRepository): string
    {
       $location = $locationRepository->findLocation($countryCode, $cityName);
       $measurements = $measurementRepository->findByLocation($location);
        return $measurements;
    }
    public function getWeatherForLocation(Location $location, MeasurementRepository $measurementRepository): string
    {
        $measurements = $measurementRepository->findByLocation($location);
        return $measurements;
    }
}