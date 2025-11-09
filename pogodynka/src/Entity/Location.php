<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'City cannot be empty.')]
    #[Assert\Length(max: 255, maxMessage: 'City name is too long.')]
    private ?string $city = null;

    #[ORM\Column(length: 2)]
    #[Assert\NotBlank(message: 'Country code is required.')]
    #[Assert\Country(message: 'Please enter a valid 2-letter country code.')]
    private ?string $country = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank(message: 'Latitude is required.')]
    #[Assert\Range(
        notInRangeMessage: 'Latitude must be between -90 and 90.',
        min: -90,
        max: 90
    )]
    private ?float $latitude = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank(message: 'Longitude is required.')]
    #[Assert\Range(
        notInRangeMessage: 'Longitude must be between -180 and 180.',
        min: -180,
        max: 180
    )]
    private ?float $longitude = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;
        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;
        return $this;
    }
}
