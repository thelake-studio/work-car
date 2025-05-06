<?php

namespace App\Entity;

use App\Repository\RecordedTripRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecordedTripRepository::class)]
class RecordedTrip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $distance = null;

    #[ORM\Column]
    private ?float $duration = null;

    #[ORM\Column]
    private ?float $fuelConsumption = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): static
    {
        $this->distance = $distance;

        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setDuration(float $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getFuelConsumption(): ?float
    {
        return $this->fuelConsumption;
    }

    public function setFuelConsumption(float $fuelConsumption): static
    {
        $this->fuelConsumption = $fuelConsumption;

        return $this;
    }
}
