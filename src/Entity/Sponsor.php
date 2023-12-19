<?php

namespace App\Entity;

use App\Repository\SponsorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SponsorRepository::class)]
class Sponsor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'sponsor', targetEntity: Edition::class)]
    private Collection $edition;

    public function __toString(): string
    {
        return $this->id . ' ' . $this->nom;
    }

    public function __construct()
    {
        $this->edition = new ArrayCollection();
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

    /**
     * @return Collection<int, Edition>
     */
    public function getEdition(): Collection
    {
        return $this->edition;
    }

    public function addEdition(Edition $edition): static
    {
        if (!$this->edition->contains($edition)) {
            $this->edition->add($edition);
            $edition->setSponsor($this);
        }

        return $this;
    }

    public function removeEdition(Edition $edition): static
    {
        if ($this->edition->removeElement($edition)) {
            // set the owning side to null (unless already changed)
            if ($edition->getSponsor() === $this) {
                $edition->setSponsor(null);
            }
        }

        return $this;
    }
}
