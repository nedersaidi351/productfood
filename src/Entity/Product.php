<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(length: 255)]
    private string $type;

    #[ORM\Column]
    private float $price;

    public function __construct(string $name, string $type, float $price)
    {
        $this->name = $name;
        $this->type = $type;
        $this->setPrice($price); // Validation du prix
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        if ($price < 0) {
            throw new \InvalidArgumentException('Le prix ne peut pas être négatif.');
        }
        $this->price = $price;
        return $this;
    }

    public function computeTVA(): float
    {
        return ($this->type === 'food') ? $this->price * 0.055 : $this->price * 0.196;
    }
}
