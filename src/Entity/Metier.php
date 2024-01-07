<?php

namespace App\Entity;

use App\Repository\MetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: Atelier::class, inversedBy: 'metier')]
    private Collection $atelier;

    #[ORM\ManyToMany(targetEntity: Activite::class, mappedBy: 'metier')]
    #[ORM\JoinTable(name: 'metier_as_activite')]
    private Collection $activite;

    #[ORM\ManyToMany(targetEntity: Competences::class, mappedBy: 'metier')]
    #[ORM\JoinTable(name: 'metier_as_competence')]
    private Collection $competence;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    public function __construct()
    {
        $this->atelier = new ArrayCollection();
        $this->activite = new ArrayCollection();
        $this->competence = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->nom;
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

    /**
     * @return Collection
     */
    public function getAtelier(): Collection
    {
        return $this->atelier;
    }



    public function addAtelier(Atelier $workshop): self
    {
        if (!$this->atelier->contains($workshop)) {
            $this->atelier->add($workshop);
            $workshop->addJob($this);
        }

        return $this;
    }

    public function removeAtelier(Atelier $workshop): self
    {
        if ($this->atelier->removeElement($workshop)) {
            $workshop->removeJob($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Activite>
     */
    public function getActivite(): Collection
    {
        return $this->activite;
    }

    public function addActivite(Activite $activite): static
    {
        if (!$this->activite->contains($activite)) {
            $this->activite->add($activite);
            $activite->addMetier($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): static
    {
        if ($this->activite->removeElement($activite)) {
            $activite->removeMetier($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Competences>
     */
    public function getCompetence(): Collection
    {
        return $this->competence;
    }

    public function addCompetence(Competences $competence): static
    {
        if (!$this->competence->contains($competence)) {
            $this->competence->add($competence);
            $competence->addMetier($this);
        }

        return $this;
    }

    public function removeCompetence(Competences $competence): static
    {
        if ($this->competence->removeElement($competence)) {
            $competence->removeMetier($this);
        }

        return $this;
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
}
