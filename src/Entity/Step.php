<?php

namespace App\Entity;

use App\Repository\StepRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StepRepository::class)]
class Step
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $position = null;

    #[ORM\ManyToOne(inversedBy: 'steps')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recipe $recipe = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $instruction = null;

    /**
     * @var Collection<int, StepIngredient>
     */
    #[ORM\OneToMany(targetEntity: StepIngredient::class, mappedBy: 'step', orphanRemoval: true)]
    private Collection $stepIngredients;

    public function __construct()
    {
        $this->stepIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): static
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    public function setInstruction(string $instruction): static
    {
        $this->instruction = $instruction;

        return $this;
    }

    /**
     * @return Collection<int, StepIngredient>
     */
    public function getStepIngredients(): Collection
    {
        return $this->stepIngredients;
    }

    public function addStepIngredient(StepIngredient $stepIngredient): static
    {
        if (!$this->stepIngredients->contains($stepIngredient)) {
            $this->stepIngredients->add($stepIngredient);
            $stepIngredient->setStep($this);
        }

        return $this;
    }

    public function removeStepIngredient(StepIngredient $stepIngredient): static
    {
        if ($this->stepIngredients->removeElement($stepIngredient)) {
            // set the owning side to null (unless already changed)
            if ($stepIngredient->getStep() === $this) {
                $stepIngredient->setStep(null);
            }
        }

        return $this;
    }
}
