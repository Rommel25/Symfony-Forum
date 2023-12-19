<?php

namespace App\Entity;

use App\Repository\IntervenantEditionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IntervenantEditionRepository::class)]
class IntervenantEdition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'intervenantEditions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Edition $edition_id = null;

    #[ORM\ManyToOne(inversedBy: 'intervenantEditions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Intervenant $intervenant_id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEditionId(): ?Edition
    {
        return $this->edition_id;
    }

    public function setEditionId(?Edition $edition_id): static
    {
        $this->edition_id = $edition_id;

        return $this;
    }

    public function getIntervenantId(): ?Intervenant
    {
        return $this->intervenant_id;
    }

    public function setIntervenantId(?Intervenant $intervenant_id): static
    {
        $this->intervenant_id = $intervenant_id;

        return $this;
    }

    public function isStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(?bool $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
