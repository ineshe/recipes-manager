<?php

namespace App\DataFixtures;

use App\Factory\TagFactory;
use App\Factory\StepFactory;
use App\Factory\UserFactory;
use App\Factory\RecipeFactory;
use App\Factory\CategoryFactory;
use App\Factory\IngredientFactory;
use Doctrine\Persistence\ObjectManager;
use App\Factory\RecipeIngredientFactory;
use App\Factory\StepIngredientFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AppFixtures extends Fixture
{
    private array $tagCache = [];
    private array $categoryCache = [];
    private array $ingredientCache = [];
    private array $recipeIngredientCache = [];

    public function load(ObjectManager $manager): void
    {
        $recipesData = $this->readJsonData('/recipes.json');
        $slugger = new AsciiSlugger();

        foreach ($recipesData as $recipeData) {
            $categoryData = array_map(function($category) use ($slugger) {
                return [
                    'title' => $category,
                    'image' => $slugger->slug($category)->lower()->toString() . '-1792x1024.webp'
                ];
            }, $recipeData['categories']);

            $recipeCategories = $this->createEntitiesIfNotExist(CategoryFactory::class, $categoryData, 'title', $this->categoryCache);

            $tagData = array_map(function($tag) {
                return ['name' => $tag];
            }, $recipeData['recipeTags']);

            $recipeTags = $this->createEntitiesIfNotExist(TagFactory::class, $tagData, 'name', $this->tagCache);

            $recipe = RecipeFactory::createOne([
                'title' => $recipeData['title'],
                'categories' => $recipeCategories,
                'image' => $recipeData['image'],
                'recipeTags' => $recipeTags,
            ]);

            $ingredientData = array_map(function($ingredient) {
                return ['name' => $ingredient['name']];
            }, $recipeData['ingredients']);

            $this->createEntitiesIfNotExist(IngredientFactory::class, $ingredientData, 'name', $this->ingredientCache);

            foreach ($recipeData['ingredients'] as $recipeIngredient) {
                $this->recipeIngredientCache[$recipeIngredient['name']] = RecipeIngredientFactory::createOne([
                    'recipe' => $recipe,
                    'ingredient' => $this->ingredientCache[$recipeIngredient['name']],
                    'amount' => $recipeIngredient['amount'],
                    'unit' => $recipeIngredient['unit'],
                ]);
            }

            foreach ($recipeData['steps'] as $step) {
                $stepObj = StepFactory::createOne([
                    'position' => $step['position'],
                    'instruction' => $step['instruction'],
                    'recipe' => $recipe,
                ]);

                foreach ($step['stepIngredients'] as $stepIngredient) {
                    StepIngredientFactory::createOne([
                        'step' => $stepObj,
                        'recipeIngredient' => $this->recipeIngredientCache[$stepIngredient['ingredient']],
                        'amount' => $stepIngredient['amount'],
                        'unit' => $stepIngredient['unit'],
                    ]);
                }
            }
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

    private function readJsonData(string $path): mixed {
        $recipesJsonPath = __DIR__ . $path;

        if (!file_exists($recipesJsonPath)) {
            throw new \RuntimeException('Die Datei recipes.json wurde nicht gefunden.');
        }

        $recipesData = json_decode(file_get_contents($recipesJsonPath), true);

        if ($recipesData === null) {
            throw new \RuntimeException('Fehler beim Parsen der JSON-Datei.');
        }

        return $recipesData;
    }

    private function createEntitiesIfNotExist(string $factoryClass, array $data, string $keyProp, array &$cache) {
        $entities = [];

        foreach ($data as $entity) {
            $entities[] = $cache[$entity[$keyProp]] ?? ($cache[$entity[$keyProp]] = $factoryClass::createOne($entity));
        }
        
        return $entities;
    }
}