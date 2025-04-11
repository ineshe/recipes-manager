<?php

namespace App\Entity;

use App\Repository\RecipeIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeIngredientRepository::class)]
class RecipeIngredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'recipeIngredients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recipe $recipe = null;

    #[ORM\ManyToOne(inversedBy: 'recipeIngredients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ingredient $ingredient = null;

    #[ORM\Column(nullable: true)]
    private ?float $amount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $unit = null;

    /**
     * @var Collection<int, StepIngredient>
     */
    #[ORM\OneToMany(targetEntity: StepIngredient::class, mappedBy: 'recipeIngredient')]
    private Collection $stepIngredients;

    public function __construct()
    {
        $this->stepIngredients = new ArrayCollection();
    }

    public function __toString(): string
    {
        return sprintf('%s %s %s', $this->getAmount(), $this->getUnit(), $this->ingredient->getName());
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): static
    {
        $this->ingredient = $ingredient;

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
            $stepIngredient->setRecipeIngredient($this);
        }

        return $this;
    }

    public function removeStepIngredient(StepIngredient $stepIngredient): static
    {
        if ($this->stepIngredients->removeElement($stepIngredient)) {
            // set the owning side to null (unless already changed)
            if ($stepIngredient->getRecipeIngredient() === $this) {
                $stepIngredient->setRecipeIngredient(null);
            }
        }

        return $this;
    }
}
