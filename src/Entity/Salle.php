<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalleRepository::class)]
class Salle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $etage = null;

    #[ORM\Column]
    private ?int $capacite_max = null;

    #[ORM\OneToMany(mappedBy: 'salle', targetEntity: Atelier::class)]
    private Collection $ateliers;

    #[ORM\Column]
    private ?int $cappacite = null;

    public function __toString(): string
    {
        // return $this->nom + $this->etage;
        return $this->nom . ' ' . $this->etage;
        
    }

    public function __construct()
    {
        $this->ateliers = new ArrayCollection();
        $this->cappacite = $this->capacite_max;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): static
    {
        $this->etage = $etage;

        return $this;
    }

    public function getCapaciteMax(): ?int
    {
        return $this->capacite_max;
    }

    public function setCapaciteMax(int $capacite_max): static
    {
        $this->capacite_max = $capacite_max;

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
            $atelier->setSalle($this);
        }

        return $this;
    }

    public function removeAtelier(Atelier $atelier): static
    {
        if ($this->ateliers->removeElement($atelier)) {
            // set the owning side to null (unless already changed)
            if ($atelier->getSalle() === $this) {
                $atelier->setSalle(null);
            }
        }

        return $this;
    }

    public function getCappacite(): ?int
    {
        return $this->cappacite;
    }

    public function setCappacite(int $cappacite): static
    {
        $this->cappacite = $cappacite;

        return $this;
    }
}
