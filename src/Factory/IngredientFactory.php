<?php

namespace App\Factory;

use App\Entity\Ingredient;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Ingredient>
 */
final class IngredientFactory extends PersistentProxyObjectFactory
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
        return Ingredient::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->randomElement(
                [
                    'Ingwer', 
                    'Frühlingszwiebel', 
                    'Zitrone',
                    'Olivenöl',
                    'Salz',
                    'Pfeffer',
                    'Aprikose',
                    'Harissa Paste',
                    'Sesamsamen',
                    'Koriander',
                    'Champignon',
                    'Basilikum',
                    'Hähnchenbrust',
                    'Nudeln',
                    'Parmesan',
                    'Ricotta',
                    'Zwiebel',
                    'Senf',
                    'Milch',
                    'Tomaten',
                    'Tomatenmark',
                    'Aubergine',
                    'Süßkartoffeln',
                    'Thunfisch',
                    'Miso Paste',
                    'Basmatireis',
                    'Kokosmilch'
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
            // ->afterInstantiate(function(Ingredient $ingredient): void {})
        ;
    }
}
