<?php

namespace App\Entity;

use App\Repository\LyceenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LyceenRepository::class)]
class Lyceen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lyceen')]
    private ?Lycee $Lycee = null;


    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Atelier::class, inversedBy: 'lyceens')]
    private Collection $ateliers;

    public function __construct()
    {
        $this->ateliers = new ArrayCollection();
        $this->edition = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getUser()->getNom().' '. $this->getUser()->getPrenom() . ' ' . $this->getLycee();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLycee(): ?Lycee
    {
        return $this->Lycee;
    }

    public function setLycee(?Lycee $Lycee): static
    {
        $this->Lycee = $Lycee;

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
        }

        return $this;
    }

    public function removeAtelier(Atelier $atelier): static
    {
        $this->ateliers->removeElement($atelier);

        return $this;
    }


}
