<?php

namespace App\Entity;

use App\Repository\CompteBancaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteBancaireRepository::class)]
class CompteBancaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $proprietaire;

    #[ORM\Column]
    private float $solde;

    public function __construct(string $proprietaire, float $solde)
    {
        $this->proprietaire = $proprietaire;
        $this->setSolde($solde); // Utilisation de setSolde() pour validation
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProprietaire(): string
    {
        return $this->proprietaire;
    }

    public function setProprietaire(string $proprietaire): static
    {
        $this->proprietaire = $proprietaire;
        return $this;
    }

    public function getSolde(): float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): static
    {
        if ($solde < 0) {
            throw new \InvalidArgumentException("Le solde ne peut pas être négatif.");
        }
        $this->solde = $solde;
        return $this;
    }

    public function retirer(float $montant): void
    {
        if ($montant <= 0) {
            throw new \InvalidArgumentException("Le montant doit être supérieur à zéro.");
        }

        if ($montant > $this->solde) {
            throw new \Exception("Solde insuffisant pour retirer {$montant} €.");
        }

        $this->solde -= $montant;
    }

    public function deposer(float $montant): void
    {
        if ($montant <= 0) {
            throw new \InvalidArgumentException("Le montant déposé doit être supérieur à zéro.");
        }
        $this->solde += $montant;
    }
}
