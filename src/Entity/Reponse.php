<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reponse = null;

    #[ORM\ManyToOne(inversedBy: 'reponses')]
    private ?Lyceen $lyceen = null;

    #[ORM\ManyToOne(inversedBy: 'reponses')]
    private ?Question $questions = null;

    public function __toString(): string
    {
        return $this->id;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): static
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getLyceen(): ?Lyceen
    {
        return $this->lyceen;
    }

    public function setLyceen(?Lyceen $lyceen): static
    {
        $this->lyceen = $lyceen;

        return $this;
    }

    public function getQuestions(): ?Question
    {
        return $this->questions;
    }

    public function setQuestions(?Question $questions): static
    {
        $this->questions = $questions;

        return $this;
    }
}
