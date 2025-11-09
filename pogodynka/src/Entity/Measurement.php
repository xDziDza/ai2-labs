<?php

namespace App\Entity;

use App\Repository\MeasurementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MeasurementRepository::class)]
class Measurement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, name: 'date')]
    #[Assert\NotNull(message: 'Date cannot be empty.')]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: 'float', name: 'celsius')]
    #[Assert\NotBlank(message: 'Temperature is required.')]
    #[Assert\Range(
        notInRangeMessage: 'Temperature must be between -100 and 100 °C.',
        min: -100,
        max: 100
    )]
    private ?float $celsius = null;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Assert\Range(
        notInRangeMessage: 'Pressure must be between 800 and 1100 hPa.',
        min: 800,
        max: 1100
    )]
    private ?float $pressure = null;

    #[ORM\ManyToOne(inversedBy: 'measurements')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: 'Measurement must be linked to a location.')]
    private ?Location $location = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getCelsius(): ?float
    {
        return $this->celsius;
    }

    public function setCelsius(float $celsius): static
    {
        $this->celsius = $celsius;
        return $this;
    }

    public function getPressure(): ?float
    {
        return $this->pressure;
    }

    public function setPressure(?float $pressure): static
    {
        $this->pressure = $pressure;
        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;
        return $this;
    }
}
