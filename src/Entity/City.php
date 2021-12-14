<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=Trip::class, mappedBy="fromCity", orphanRemoval=true)
     */
    private $tripsFrom;

    /**
     * @ORM\OneToMany(targetEntity=Trip::class, mappedBy="toCity", orphanRemoval=true)
     */
    private $tripsTo;


    public function __construct()
    {
        $this->tripsFrom = new ArrayCollection();
        $this->tripsTo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Trip[]
     */
    public function getTripsFrom(): Collection
    {
        return $this->tripsFrom;
    }

    public function addTripFrom(Trip $trip): self
    {
        if (!$this->tripsFrom->contains($trip)) {
            $this->tripsFrom[] = $trip;
            $trip->setFromCity($this);
        }

        return $this;
    }

    public function removeTripFrom(Trip $trip): self
    {
        if ($this->tripsFrom->removeElement($trip)) {
            // set the owning side to null (unless already changed)
            if ($trip->getFromCity() === $this) {
                $trip->setFromCity(null);
            }
        }

        return $this;
    }


        /**
     * @return Collection|Trip[]
     */
    public function getTripsTo(): Collection
    {
        return $this->tripsTo;
    }

    public function addTripTo(Trip $trip): self
    {
        if (!$this->tripsTo->contains($trip)) {
            $this->tripsTo[] = $trip;
            $trip->setFromCity($this);
        }

        return $this;
    }

    public function removeTripTo(Trip $trip): self
    {
        if ($this->tripsTo->removeElement($trip)) {
            // set the owning side to null (unless already changed)
            if ($trip->getFromCity() === $this) {
                $trip->setFromCity(null);
            }
        }

        return $this;
    }
}
