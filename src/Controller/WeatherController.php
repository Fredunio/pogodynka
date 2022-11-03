<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Location;
use App\Repository\MeasurementRepository;
use App\Service\WeatherUtil;

class WeatherController extends AbstractController
{
    public function cityAction(Location $city, WeatherUtil $weatherUtil,  MeasurementRepository $measurementRepository): Response
    {
        $measurements = $measurementRepository->findByLocation($city);
        // $measurements = $weatherUtil->getWeatherForLocation($city);
     
        return $this->render('weather/city.html.twig', [
            'location' => $city,
            'measurements' => $measurements,
        ]);
    }
}
