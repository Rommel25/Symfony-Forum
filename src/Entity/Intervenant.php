<?php

namespace App\Entity;

use App\Repository\IntervenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IntervenantRepository::class)]
class Intervenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $entreprise = null;


    #[ORM\OneToMany(mappedBy: 'intervenant_id', targetEntity: IntervenantEdition::class)]
    private Collection $intervenantEditions;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Atelier::class, mappedBy: 'intervenants')]
    private Collection $ateliers;

    public function __construct()
    {
        $this->intervenantEditions = new ArrayCollection();
        $this->ateliers = new ArrayCollection();
    }

    public function __toString(): string
    {
        // return $this->prenom + $this->nom;
        return $this->getUser()->getPrenom() . ' ' . $this->getUser()->getNom();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): static
    {
        $this->entreprise = $entreprise;

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
            $intervenantEdition->setIntervenantId($this);
        }

        return $this;
    }

    public function removeIntervenantEdition(IntervenantEdition $intervenantEdition): static
    {
        if ($this->intervenantEditions->removeElement($intervenantEdition)) {
            // set the owning side to null (unless already changed)
            if ($intervenantEdition->getIntervenantId() === $this) {
                $intervenantEdition->setIntervenantId(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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
            $atelier->addIntervenant($this);
        }

        return $this;
    }

    public function removeAtelier(Atelier $atelier): static
    {
        if ($this->ateliers->removeElement($atelier)) {
            $atelier->removeIntervenant($this);
        }

        return $this;
    }
}
