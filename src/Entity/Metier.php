<?php

namespace App\Entity;

use App\Repository\MetierRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetierRepository::class)]
class Metier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $competences = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $activites = [];

    #[ORM\ManyToOne(inversedBy: 'metier')]
    private ?Atelier $atelier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompetences(): array
    {
        return $this->Competences;
    }

    public function setCompetences(array $Competences): static
    {
        $this->Competences = $Competences;

        return $this;
    }

    public function getActivites(): array
    {
        return $this->Activites;
    }

    public function setActivites(array $Activites): static
    {
        $this->Activites = $Activites;

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
