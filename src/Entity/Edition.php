<?php

namespace App\Entity;

use App\Repository\EditionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditionRepository::class)]
class Edition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $annee = null;

    #[ORM\ManyToMany(targetEntity: Atelier::class, mappedBy: 'edition')]
    private Collection $ateliers;

    #[ORM\ManyToMany(targetEntity: Questionnaire::class, mappedBy: 'edition')]
    private Collection $questionnaires;

    #[ORM\ManyToOne(inversedBy: 'edition')]
    private ?Sponsor $sponsor = null;

    #[ORM\OneToMany(mappedBy: 'edition_id', targetEntity: IntervenantEdition::class)]
    private Collection $intervenantEditions;

    #[ORM\ManyToMany(targetEntity: Lyceen::class, mappedBy: 'edition')]
    private Collection $lyceens;

    public function __toString(): string
    {
        return $this->id . $this->annee;
    }

    public function __construct()
    {
        $this->ateliers = new ArrayCollection();
        $this->questionnaires = new ArrayCollection();
        $this->intervenantEditions = new ArrayCollection();
        $this->lyceens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * @return Collection<int, Atelier>
     */
    public function getAteliers(): Collection
    {
        return $this->ateliers;
    }

    public function addAtelier(Atelier $atelier): static
    {
        if (!$this->ateliers->contains($atelier)) {
            $this->ateliers->add($atelier);
            $atelier->addEdition($this);
        }

        return $this;
    }

    public function removeAtelier(Atelier $atelier): static
    {
        if ($this->ateliers->removeElement($atelier)) {
            $atelier->removeEdition($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Questionnaire>
     */
    public function getQuestionnaires(): Collection
    {
        return $this->questionnaires;
    }

    public function addQuestionnaire(Questionnaire $questionnaire): static
    {
        if (!$this->questionnaires->contains($questionnaire)) {
            $this->questionnaires->add($questionnaire);
            $questionnaire->addEdition($this);
        }

        return $this;
    }

    public function removeQuestionnaire(Questionnaire $questionnaire): static
    {
        if ($this->questionnaires->removeElement($questionnaire)) {
            $questionnaire->removeEdition($this);
        }

        return $this;
    }

    public function getSponsor(): ?Sponsor
    {
        return $this->sponsor;
    }

    public function setSponsor(?Sponsor $sponsor): static
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    /**
     * @return Collection<int, IntervenantEdition>
     */
    public function getIntervenantEditions(): Collection
    {
        return $this->intervenantEditions;
    }

    public function addIntervenantEdition(IntervenantEdition $intervenantEdition): static
    {
        if (!$this->intervenantEditions->contains($intervenantEdition)) {
            $this->intervenantEditions->add($intervenantEdition);
            $intervenantEdition->setEditionId($this);
        }

        return $this;
    }

    public function removeIntervenantEdition(IntervenantEdition $intervenantEdition): static
    {
        if ($this->intervenantEditions->removeElement($intervenantEdition)) {
            // set the owning side to null (unless already changed)
            if ($intervenantEdition->getEditionId() === $this) {
                $intervenantEdition->setEditionId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Lyceen>
     */
    public function getLyceens(): Collection
    {
        return $this->lyceens;
    }

    public function addLyceen(Lyceen $lyceen): static
    {
        if (!$this->lyceens->contains($lyceen)) {
            $this->lyceens->add($lyceen);
            $lyceen->addEdition($this);
        }

        return $this;
    }

    public function removeLyceen(Lyceen $lyceen): static
    {
        if ($this->lyceens->removeElement($lyceen)) {
            $lyceen->removeEdition($this);
        }

        return $this;
    }
}
