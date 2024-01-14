<?php

namespace App\Entity;

use App\Repository\LyceeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LyceeRepository::class)]
class Lycee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'Lycee', targetEntity: Lyceen::class)]
    private Collection $lyceen;

    #[ORM\OneToMany(mappedBy: 'lycee', targetEntity: User::class)]
    private Collection $userAdmin;

    public function __toString(): string
    {
        return $this->id . ' ' . $this->nom;
    }

    public function __construct()
    {
        $this->lyceen = new ArrayCollection();
        $this->userAdmin = new ArrayCollection();
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
     * @return Collection<int, Lyceen>
     */
    public function getlyceen(): Collection
    {
        return $this->lyceen;
    }

    public function addAtelier(Lyceen $atelier): static
    {
        if (!$this->lyceen->contains($atelier)) {
            $this->lyceen->add($atelier);
            $atelier->setLycee($this);
        }

        return $this;
    }

    public function removeAtelier(Lyceen $atelier): static
    {
        if ($this->lyceen->removeElement($atelier)) {
            // set the owning side to null (unless already changed)
            if ($atelier->getLycee() === $this) {
                $atelier->setLycee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserAdmin(): Collection
    {
        return $this->userAdmin;
    }

    public function addUserAdmin(User $userAdmin): static
    {
        if (!$this->userAdmin->contains($userAdmin)) {
            $this->userAdmin->add($userAdmin);
            $userAdmin->setLycee($this);
        }

        return $this;
    }

    public function removeUserAdmin(User $userAdmin): static
    {
        if ($this->userAdmin->removeElement($userAdmin)) {
            // set the owning side to null (unless already changed)
            if ($userAdmin->getLycee() === $this) {
                $userAdmin->setLycee(null);
            }
        }

        return $this;
    }
}
