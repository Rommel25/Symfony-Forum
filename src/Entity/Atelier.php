<?php

namespace App\Entity;

use App\Repository\AtelierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: AtelierRepository::class)]
class Atelier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'atelier', targetEntity: Metier::class)]
    private ?Collection $metier = null;

    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    private ?Secteur $secteur = null;

    #[ORM\OneToMany(mappedBy: 'atelier', targetEntity: Intervenant::class)]
    private ?Collection $intervenants;

    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    private ?Salle $salle = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'ateliers')]
    private Collection $users;

    #[ORM\ManyToMany(targetEntity: Edition::class, inversedBy: 'ateliers')]
    private Collection $edition;

    #[ORM\ManyToMany(targetEntity: Ressources::class, inversedBy: 'ateliers')]
    private Collection $ressource;

    public function __toString(): string
    {
        return $this->id;
    }


    public function __construct()
    {
        $this->metier = new ArrayCollection();
        $this->intervenants = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->edition = new ArrayCollection();
        $this->ressource = new ArrayCollection();
    }

//    public function removeMetier(Metier $metier): self
//    {
//        if ($this->metier->contains($metier)) {
//            $this->metier->removeElement($metier);
//            // déclenchez la suppression de l'entité Metier
//            $metier->setAtelier(null);
//        }
//
//        return $this;
//    }

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

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addAtelier($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeAtelier($this);
        }

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
        }

        return $this;
    }

    public function removeEdition(Edition $edition): static
    {
        $this->edition->removeElement($edition);

        return $this;
    }

    /**
     * @return Collection<int, Ressources>
     */
    public function getRessource(): Collection
    {
        return $this->ressource;
    }

    public function addRessource(Ressources $ressource): static
    {
        if (!$this->ressource->contains($ressource)) {
            $this->ressource->add($ressource);
        }

        return $this;
    }

    public function removeRessource(Ressources $ressource): static
    {
        $this->ressource->removeElement($ressource);

        return $this;
    }

}
