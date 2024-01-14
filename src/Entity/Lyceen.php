<?php

namespace App\Entity;

use App\Enum\SectionEnum;
use App\Repository\LyceenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotNull;

#[ORM\Entity(repositoryClass: LyceenRepository::class)]
class Lyceen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lyceen')]
    private ?Lycee $Lycee = null;

    #[ORM\Column(length: 50)]
    private ?string $section = SectionEnum::SECOND;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Atelier::class, inversedBy: 'lyceens')]
    private Collection $ateliers;

    #[ORM\OneToMany(mappedBy: 'lyceen', targetEntity: Reponse::class)]
    private Collection $reponses;

    public function __construct()
    {
        $this->ateliers = new ArrayCollection();
        $this->edition = new ArrayCollection();
        $this->reponses = new ArrayCollection();
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

    public function getDegreeValue()
    {
        return SectionEnum::getDegree($this->section);
    }

    /**
     * @return string|null
     */
    public function getSection(): ?string
    {
        return $this->section;
    }

    /**
     * @param string|null $section
     */
    public function setSection(?string $section): void
    {
        $this->section = $section;
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

    /**
     * @return Collection<int, Reponse>
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): static
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses->add($reponse);
            $reponse->setLyceen($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): static
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getLyceen() === $this) {
                $reponse->setLyceen(null);
            }
        }

        return $this;
    }


}
