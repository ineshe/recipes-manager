<?php

namespace App\DataFixtures;

use App\Factory\IngredientFactory;
use App\Factory\RecipeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        RecipeFactory::createMany(7, ['ingredients' => IngredientFactory::new()->many(5, 12)]);

        $manager->flush();
    }
}
