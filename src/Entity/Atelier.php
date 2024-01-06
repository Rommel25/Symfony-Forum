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

    #[ORM\ManyToMany(inversedBy: 'atelier', targetEntity: Metier::class)]
    #[ORM\JoinTable(name: 'atelier_as_metier')]
    private Collection $metier;

    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    private ?Secteur $secteur = null;

    #[ORM\OneToMany(mappedBy: 'atelier', targetEntity: Intervenant::class)]
    private ?Collection $intervenants;

    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    private ?Salle $salle = null;

    #[ORM\ManyToMany(targetEntity: Edition::class, inversedBy: 'ateliers')]
    private Collection $edition;

    #[ORM\ManyToMany(targetEntity: Ressources::class, inversedBy: 'ateliers')]
    private Collection $ressource;

    #[ORM\ManyToMany(targetEntity: Lyceen::class, mappedBy: 'ateliers')]
    private Collection $lyceens;

    #[ORM\ManyToMany(targetEntity: Forum::class, mappedBy: 'ateliers')]
    private Collection $forums;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    public function __toString(): string
    {
        return $this->nom;
    }


    public function __construct()
    {
        $this->metier = new ArrayCollection();
        $this->intervenants = new ArrayCollection();
        $this->edition = new ArrayCollection();
        $this->ressource = new ArrayCollection();
        $this->lyceens = new ArrayCollection();
        $this->forums = new ArrayCollection();
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
     * @return Collection
     */
    public function getMetier(): Collection
    {
        return $this->metier;
    }

    /**
     * @param Collection $metier
     */
    public function setMetier(Collection $metier): void
    {
        $this->metier = $metier;
    }

    public function addJob(Metier $job): self
    {
        if (!$this->metier->contains($job)) {
            $this->metier->add($job);
        }

        return $this;
    }

    public function removeJob(Metier $job): self
    {
        $this->metier->removeElement($job);

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
            $lyceen->addAtelier($this);
        }

        return $this;
    }

    public function removeLyceen(Lyceen $lyceen): static
    {
        if ($this->lyceens->removeElement($lyceen)) {
            $lyceen->removeAtelier($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Forum>
     */
    public function getForums(): Collection
    {
        return $this->forums;
    }

    public function addForum(Forum $forum): static
    {
        if (!$this->forums->contains($forum)) {
            $this->forums->add($forum);
            $forum->addAtelier($this);
        }

        return $this;
    }

    public function removeForum(Forum $forum): static
    {
        if ($this->forums->removeElement($forum)) {
            $forum->removeAtelier($this);
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

