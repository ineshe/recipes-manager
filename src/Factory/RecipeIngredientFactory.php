<?php

namespace App\Factory;

use App\Entity\RecipeIngredient;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<RecipeIngredient>
 */
final class RecipeIngredientFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return RecipeIngredient::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'ingredient' => IngredientFactory::new(),
            'recipe' => RecipeFactory::new(),
            'amount' => self::faker()->randomElement(
                [
                    1, 
                    2,
                    3,
                    4,
                    5,
                    100,
                    175,
                    200,
                    350,
                    500,
                ]
            ),
            'unit' => self::faker()->randomElement(
                [
                    'Stück', 
                    'Prise',
                    'Bund',
                    'g',
                    'EL',
                    'TL',
                ]
            ),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(RecipeIngredient $recipeIngredient): void {})
        ;
    }
}
