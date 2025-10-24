<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use App\Repository\MeasurmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class WeatherController extends AbstractController
{
    #[Route('/weather/{city}', name: 'app_weather_city')]
    public function city(
        string $city,
        LocationRepository $locationRepository,
        MeasurmentRepository $measurementRepository
    ): Response {
        // Szukamy lokalizacji po nazwie miasta
        $location = $locationRepository->findOneBy(['city' => $city]);

        if (!$location) {
            throw new NotFoundHttpException("Location '$city' not found.");
        }

        $measurements = $measurementRepository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }
}
