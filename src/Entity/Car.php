<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $brand = null;

    #[ORM\Column(length: 50)]
    private ?string $model = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?int $mileage = null;

    #[ORM\Column(length: 50)]
    private ?string $energy = null;

    #[ORM\Column(length: 50)]
    private ?string $gearbox = null;

    #[ORM\Column]
    private ?int $doors = null;

    #[ORM\Column]
    private ?int $horsepower = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\ManyToOne(targetEntity: "App\Entity\User", inversedBy: "car")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id")]
    private $user;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: CarImage::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $carImages;

    public function __construct()
    {
        $this->carImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getEnergy(): ?string
    {
        return $this->energy;
    }

    public function setEnergy(string $energy): static
    {
        $this->energy = $energy;

        return $this;
    }

    public function getGearbox(): ?string
    {
        return $this->gearbox;
    }

    public function setGearbox(string $gearbox): static
    {
        $this->gearbox = $gearbox;

        return $this;
    }

    public function getDoors(): ?int
    {
        return $this->doors;
    }

    public function setDoors(int $doors): static
    {
        $this->doors = $doors;

        return $this;
    }

    public function getHorsepower(): ?int
    {
        return $this->horsepower;
    }

    public function setHorsepower(int $horsepower): static
    {
        $this->horsepower = $horsepower;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     */
    public function setUser($user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CarImage>
     */
    public function getCarImages(): Collection
    {
        return $this->carImages;
    }

    public function addCarImage(CarImage $carImage): static
    {
        if (!$this->carImages->contains($carImage)) {
            $this->carImages->add($carImage);
            $carImage->setCar($this);
        }

        return $this;
    }

    public function removeCarImage(CarImage $carImage): static
    {
        if ($this->carImages->removeElement($carImage)) {
            // set the owning side to null (unless already changed)
            if ($carImage->getCar() === $this) {
                $carImage->setCar(null);
            }
        }

        return $this;
    }
}
