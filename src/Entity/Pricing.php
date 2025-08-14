<?php

namespace App\Entity;

use App\Repository\PricingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PricingRepository::class)]
class Pricing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $serviceName = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(length: 32)]
    private ?string $unit = null;

    public function getId(): ?int { return $this->id; }
    public function getServiceName(): ?string { return $this->serviceName; }
    public function setServiceName(string $serviceName): self { $this->serviceName = $serviceName; return $this; }
    public function getPrice(): ?string { return $this->price; }
    public function setPrice(string $price): self { $this->price = $price; return $this; }
    public function getUnit(): ?string { return $this->unit; }
    public function setUnit(string $unit): self { $this->unit = $unit; return $this; }
}
