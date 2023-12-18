<?php

namespace App\Entity;

use App\Repository\AtelierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AtelierRepository::class)]
class Atelier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'atelier', targetEntity: metier::class)]
    private Collection $metier;

    #[ORM\Column(length: 255)]
    private ?string $ressources = null;

    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    private ?Secteur $secteur = null;

    #[ORM\OneToMany(mappedBy: 'atelier', targetEntity: Intervenant::class)]
    private Collection $intervenants;

    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    private ?Salle $salle = null;

    public function __construct()
    {
        $this->metier = new ArrayCollection();
        $this->intervenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, metier>
     */
    public function getMetier(): Collection
    {
        return $this->metier;
    }

    public function addMetier(metier $metier): static
    {
        if (!$this->metier->contains($metier)) {
            $this->metier->add($metier);
            $metier->setAtelier($this);
        }

        return $this;
    }

    public function removeMetier(metier $metier): static
    {
        if ($this->metier->removeElement($metier)) {
            // set the owning side to null (unless already changed)
            if ($metier->getAtelier() === $this) {
                $metier->setAtelier(null);
            }
        }

        return $this;
    }

    public function getRessources(): ?string
    {
        return $this->ressources;
    }

    public function setRessources(string $ressources): static
    {
        $this->ressources = $ressources;

        return $this;
    }

    public function getSecteur(): ?Secteur
    {
        return $this->secteur;
    }

    public function setSecteur(?Secteur $secteur): static
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * @return Collection<int, Intervenant>
     */
    public function getIntervenants(): Collection
    {
        return $this->intervenants;
    }

    public function addIntervenant(Intervenant $intervenant): static
    {
        if (!$this->intervenants->contains($intervenant)) {
            $this->intervenants->add($intervenant);
            $intervenant->setAtelier($this);
        }

        return $this;
    }

    public function removeIntervenant(Intervenant $intervenant): static
    {
        if ($this->intervenants->removeElement($intervenant)) {
            // set the owning side to null (unless already changed)
            if ($intervenant->getAtelier() === $this) {
                $intervenant->setAtelier(null);
            }
        }

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): static
    {
        $this->salle = $salle;

        return $this;
    }
}
