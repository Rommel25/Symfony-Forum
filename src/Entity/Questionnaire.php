<?php

namespace App\Entity;

use App\Repository\QuestionnaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionnaireRepository::class)]
class Questionnaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Edition::class, inversedBy: 'questionnaires')]
    private Collection $edition;

    #[ORM\ManyToMany(targetEntity: Question::class, inversedBy: 'questionnaires')]
    private Collection $Question;

    public function __toString(): string
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->edition = new ArrayCollection();
        $this->Question = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Question>
     */
    public function getQuestion(): Collection
    {
        return $this->Question;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->Question->contains($question)) {
            $this->Question->add($question);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        $this->Question->removeElement($question);

        return $this;
    }
}
