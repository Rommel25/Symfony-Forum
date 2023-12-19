<?php

namespace App\Entity;

use App\Repository\MetierRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: MetierRepository::class)]
class Metier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::ARRAY)]
    private ?array $competences = [];

    #[ORM\Column(type: Types::ARRAY)]
    private ?array $activites = [];

    #[ORM\ManyToOne(targetEntity: Atelier::class, inversedBy: 'metier')]
    private ?Atelier $atelier = null;

    public function __toString(): string
    {
        return $this->atelier;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompetences(): array
    {
        return $this->competences;
    }

    public function setCompetences(array $competences): static
    {
        $this->competences = $competences;

        return $this;
    }

    public function getActivites(): array
    {
        return $this->activites;
    }

    public function setActivites(array $activites): static
    {
        $this->activites = $activites;

        return $this;
    }

    public function getAtelier(): ?Atelier
    {
        return $this->atelier;
    }

    public function setAtelier(?Atelier $atelier): static
    {
        $this->atelier = $atelier;

        return $this;
    }
}
