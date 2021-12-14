<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TripRepository::class)
 */
class Trip
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="trips")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fromCity;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="trips")
     * @ORM\JoinColumn(nullable=false)
     */
    private $toCity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $distance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromCity(): ?City
    {
        return $this->fromCity;
    }

    public function setFromCity(?City $fromCity): self
    {
        $this->fromCity = $fromCity;

        return $this;
    }

    public function getToCity(): ?City
    {
        return $this->toCity;
    }

    public function setToCity(?City $toCity): self
    {
        $this->toCity = $toCity;

        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(?int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }
}
