<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use App\Factory\TagFactory;
use App\Factory\StepFactory;
use App\Factory\UserFactory;
use App\Factory\RecipeFactory;
use App\Factory\CategoryFactory;
use App\Factory\IngredientFactory;
use Doctrine\Persistence\ObjectManager;
use App\Factory\RecipeIngredientFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private array $tagCache = [];
    private array $categoryMap = [];
    private array $ingredientCache = [];

    public function load(ObjectManager $manager): void
    {
        $recipesJsonPath = __DIR__ . '/recipes.json';

        if (!file_exists($recipesJsonPath)) {
            throw new \RuntimeException('Die Datei recipes.json wurde nicht gefunden.');
        }

        $recipesData = json_decode(file_get_contents($recipesJsonPath), true);

        if ($recipesData === null) {
            throw new \RuntimeException('Fehler beim Parsen der JSON-Datei.');
        }

        $categories = CategoryFactory::createSequence([
            ['title' => 'Hauptgerichte', 'image' => 'hauptgerichte-1792x1024.webp'], 
            ['title' => 'Desserts', 'image' => 'desserts-1792x1024.webp' ], 
            ['title' => 'Getränke', 'image' => 'getraenke-1792x1024.webp'],
        ]);

        foreach ($categories as $category) {
            $this->categoryMap[$category->getTitle()] = $category;
        }

        foreach ($recipesData as $recipeData) {
            $recipeTags = $this->loadTags($recipeData['recipeTags']);
            $recipeCategories = $this->loadCategories($recipeData['categories']);

            $recipe = RecipeFactory::createOne([
                'title' => $recipeData['title'],
                'method' => $recipeData['method'],
                'categories' => $recipeCategories,
                'image' => $recipeData['image'],
                'recipeTags' => $recipeTags,
            ]);

            foreach ($recipeData['steps'] as $step) {
                StepFactory::createOne([
                    'position' => $step['position'],
                    'instruction' => $step['instruction'],
                    'recipe' => $recipe,
                ]);
            }

            $this->loadIngredients($recipeData['ingredients'], $recipe->_real());
        }

        UserFactory::createSequence([
            [
                'roles' => ['ROLE_ADMIN'],
                'username' => 'user1',
            ], [
                'roles' => ['ROLE_USER'],
                'username' => 'user2',
            ]
        ]);

        $manager->flush();
    }

    private function loadTags(array $tagNames): array {
        $recipeTags = [];
        foreach ($tagNames as $tagName) {
            $recipeTags[] = $this->tagCache[$tagName] ?? ($this->tagCache[$tagName] = TagFactory::createOne([
                'name' => $tagName
            ]));
        }
        return $recipeTags;
    }

    private function loadCategories(array $categoryTitles): array {
        $recipeCategories = [];
        foreach ($categoryTitles as $categoryTitle) {
            if(!isset($this->categoryMap[$categoryTitle])) {
                throw new \RuntimeException("Kategorie '{$categoryTitle}' nicht gefunden.");
            }
            $recipeCategories[] = $this->categoryMap[$categoryTitle];
        }
        return $recipeCategories;
    }

    private function loadIngredients(array $ingredients, Recipe $recipe): void {
        foreach ($ingredients as $ingredient) {
            $this->ingredientCache[$ingredient['name']] ??= (IngredientFactory::createOne([
                'name' => $ingredient['name']
            ]));

            RecipeIngredientFactory::createOne([
                'recipe' => $recipe,
                'ingredient' => $this->ingredientCache[$ingredient['name']],
                'amount' => $ingredient['amount'],
                'unit' => $ingredient['unit'],
            ]);
        }
    }
}