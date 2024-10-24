<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\IngredientFactory;
use App\Factory\RecipeFactory;
use App\Factory\RecipeIngredientFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $recipes = RecipeFactory::createMany(7);

        IngredientFactory::createMany(20);

        CategoryFactory::createSequence(
            [
                [
                    'title' => 'Hauptgerichte',
                    'recipes' => RecipeFactory::randomSet(5),
                ], [
                    'title' => 'Gebäck',
                    'recipes' => RecipeFactory::randomSet(3),

                ], [
                    'title' => 'Getränke',
                    'recipes' => RecipeFactory::randomSet(2),
                ],
            ]
        );

        foreach ($recipes as $recipe) {
            $ingredients = IngredientFactory::randomRange(4, 10);
            foreach ($ingredients as $ingredient) {
                RecipeIngredientFactory::createOne([
                    'ingredient' => $ingredient,
                    'recipe' => $recipe,
                ]);
            }
        };

        $manager->flush();
    }
}
