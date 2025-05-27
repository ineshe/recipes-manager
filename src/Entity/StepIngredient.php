<?php

namespace App\Entity;

use App\Repository\StepIngredientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StepIngredientRepository::class)]
class StepIngredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'stepIngredients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Step $step = null;

    #[ORM\ManyToOne(inversedBy: 'stepIngredients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RecipeIngredient $recipeIngredient = null;

    #[ORM\Column(nullable: true)]
    private ?float $amount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $unit = null;

    public function __toString(): string
    {
        return $this->getRecipeIngredient();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStep(): ?Step
    {
        return $this->step;
    }

    public function setStep(?Step $step): static
    {
        $this->step = $step;

        return $this;
    }

    public function getRecipeIngredient(): ?RecipeIngredient
    {
        return $this->recipeIngredient;
    }

    public function setRecipeIngredient(?RecipeIngredient $recipeIngredient): static
    {
        $this->recipeIngredient = $recipeIngredient;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(?string $unit): static
    {
        $this->unit = $unit;

        return $this;
    }
}
