<?php

namespace App\DataFixtures;

use App\Factory\RecipeFactory;
use App\Factory\CategoryFactory;
use App\Factory\IngredientFactory;
use Doctrine\Persistence\ObjectManager;
use App\Factory\RecipeIngredientFactory;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $recipesData = [
            [
                'title' => 'Klassischer Kartoffelsalat',
                'method' => <<<TEXT
                                Die Kartoffeln mit Schale in einem großen Topf mit Salzwasser etwa 20 Minuten kochen, bis sie gar, aber noch bissfest sind. Anschließend abgießen, etwas abkühlen lassen, pellen und in Scheiben schneiden.

                                Während die Kartoffeln abkühlen, die Salatgurke waschen und in dünne Scheiben hobeln. Die Zwiebel schälen und fein würfeln.

                                Die Gemüsebrühe erhitzen und den Senf sowie den Weißweinessig einrühren. Mit Salz und Pfeffer abschmecken. Die warme Brühe über die Kartoffelscheiben geben und alles gut vermengen. Etwa 20 Minuten ziehen lassen, damit die Kartoffeln die Flüssigkeit aufnehmen.

                                Anschließend die Gurkenscheiben und die Zwiebelwürfel unterheben. Das Sonnenblumenöl dazugeben und den Salat erneut vorsichtig vermengen.

                                Mit gehackter Petersilie bestreuen und vor dem Servieren mindestens eine Stunde im Kühlschrank durchziehen lassen.
                                TEXT,
                'categories' => ['Hauptgerichte'],
                'imagePath' => '/images/kartoffelsalat-1792X1024.webp',
                'ingredients' => [
                    ['amount' => 1, 'unit' => 'kg', 'name' => 'festkochende Kartoffeln'], 
                    ['amount' => 1,  'unit' => '', 'name' => 'Salatgurke'], 
                    ['amount' => 1,  'unit' => '', 'name' => 'große Zwiebel'], 
                    ['amount' => 200, 'unit' => 'ml', 'name' => 'Gemüsebrühe'], 
                    ['amount' => 5, 'unit' => 'EL', 'name' => 'Weißweinessig'], 
                    ['amount' => 4, 'unit' => 'EL',  'name' => 'Sonnenblumenöl'], 
                    ['amount' => 1, 'unit' => 'TL', 'name' => 'Senf'], 
                    ['amount' => null, 'unit' => '', 'name' => 'Salz'], 
                    ['amount' => null, 'unit' => '', 'name' => 'Pfeffer'], 
                    ['amount' => 1, 'unit' => 'Bund', 'name' => 'Petersilie, gehackt'],
                ],
            ], [
                'title' => 'Spaghetti Bolognese',
                'method' => <<<TEXT
                                Das Olivenöl in einer großen Pfanne erhitzen und das Hackfleisch darin anbraten, bis es krümelig ist. Die Zwiebel und den Knoblauch fein würfeln und zum Hackfleisch geben. Mit Salz und Pfeffer würzen.
        
                                Die Karotten schälen, fein raspeln und in die Pfanne geben. Das Tomatenmark hinzufügen und kurz anschwitzen. Anschließend die stückigen Tomaten dazugeben und alles gut verrühren.
        
                                Die Soße mit Oregano, Basilikum und einer Prise Zucker würzen. Mindestens 30 Minuten auf niedriger Stufe köcheln lassen. Dabei gelegentlich umrühren.
        
                                Die Spaghetti nach Packungsanweisung in Salzwasser al dente kochen. Abgießen und mit der Bolognesesoße servieren. Nach Belieben mit geriebenem Parmesan bestreuen.
                                TEXT,
                'categories' => ['Hauptgerichte'],                                
                'imagePath' => '/images/spaghetti-bolognese-1792X1024.webp',
                'ingredients' => [
                    ['amount' => 500, 'unit' => 'g', 'name' => 'Spaghetti'],
                    ['amount' => 400, 'unit' => 'g', 'name' => 'Hackfleisch (Rind)'],
                    ['amount' => 1, 'unit' => '', 'name' => 'große Zwiebel'],
                    ['amount' => 2, 'unit' => 'Zehen', 'name' => 'Knoblauch'],
                    ['amount' => 2, 'unit' => '', 'name' => 'Karotten'],
                    ['amount' => 400, 'unit' => 'g', 'name' => 'stückige Tomaten'],
                    ['amount' => 2, 'unit' => 'EL', 'name' => 'Tomatenmark'],
                    ['amount' => null, 'unit' => '', 'name' => 'Olivenöl'],
                    ['amount' => null, 'unit' => '', 'name' => 'Oregano'],
                    ['amount' => null, 'unit' => '', 'name' => 'Basilikum'],
                    ['amount' => null, 'unit' => '', 'name' => 'Salz'],
                    ['amount' => null, 'unit' => '', 'name' => 'Pfeffer'],
                    ['amount' => null, 'unit' => '', 'name' => 'Zucker'],
                    ['amount' => null, 'unit' => '', 'name' => 'Parmesan, gerieben'],
                ],
            ], [
                'title' => 'Kartoffel-Brokkoli-Auflauf',
                'method' => <<<TEXT
                                Die Kartoffeln schälen, in Scheiben schneiden und in Salzwasser 10 Minuten vorkochen. Den Brokkoli in Röschen teilen und ebenfalls kurz blanchieren.
        
                                Eine Auflaufform einfetten und die Kartoffelscheiben sowie den Brokkoli darin verteilen. Die Sahne mit Eiern verquirlen, mit Salz, Pfeffer und Muskat würzen und über das Gemüse gießen.
        
                                Den Käse reiben und gleichmäßig über den Auflauf streuen. Bei 180 °C (Ober-/Unterhitze) etwa 30 Minuten goldbraun backen. Vor dem Servieren etwas abkühlen lassen.
                                TEXT,
                'categories' => ['Hauptgerichte'],
                'imagePath' => '/images/kartoffel-brokkoli-auflauf-1792X1024.webp',
                'ingredients' => [
                    ['amount' => 800, 'unit' => 'g', 'name' => 'Kartoffeln'],
                    ['amount' => 500, 'unit' => 'g', 'name' => 'Brokkoli'],
                    ['amount' => 200, 'unit' => 'ml', 'name' => 'Sahne'],
                    ['amount' => 2, 'unit' => '', 'name' => 'Eier'],
                    ['amount' => 100, 'unit' => 'g', 'name' => 'geriebener Käse'],
                    ['amount' => null, 'unit' => '', 'name' => 'Salz'],
                    ['amount' => null, 'unit' => '', 'name' => 'Pfeffer'],
                    ['amount' => null, 'unit' => '', 'name' => 'Muskat'],
                ],
            ], [
                'title' => 'Butter Chicken',
                'method' => <<<TEXT
                                Das Hähnchenbrustfilet in mundgerechte Stücke schneiden und mit Joghurt, Knoblauch, Ingwer, Garam Masala, Kurkuma, Paprika und Salz marinieren. Mindestens 2 Stunden ziehen lassen.
        
                                Die Zwiebel fein hacken und in einem großen Topf mit etwas Öl anschwitzen. Die Tomaten hinzufügen und kurz mitkochen. Dann die marinierten Hähnchenstücke dazugeben und alles gut vermengen.
        
                                Die Sahne und die Butter hinzufügen und das Gericht bei schwacher Hitze 20-30 Minuten köcheln lassen. Mit frischem Koriander garnieren und mit Reis oder Naan servieren.
                                TEXT,
                'categories' => ['Hauptgerichte'],               
                'imagePath' => '/images/butter-chicken-1792X1024.webp',
                'ingredients' => [
                    ['amount' => 500, 'unit' => 'g', 'name' => 'Hähnchenbrustfilet'],
                    ['amount' => 150, 'unit' => 'g', 'name' => 'Joghurt'],
                    ['amount' => 2, 'unit' => 'Zehen', 'name' => 'Knoblauch'],
                    ['amount' => 1, 'unit' => 'Stück', 'name' => 'Ingwer (klein)'],
                    ['amount' => 2, 'unit' => 'TL', 'name' => 'Garam Masala'],
                    ['amount' => 1, 'unit' => 'TL', 'name' => 'Kurkuma'],
                    ['amount' => 1, 'unit' => 'TL', 'name' => 'Paprikapulver'],
                    ['amount' => null, 'unit' => '', 'name' => 'Salz'],
                    ['amount' => 200, 'unit' => 'ml', 'name' => 'Sahne'],
                    ['amount' => 50, 'unit' => 'g', 'name' => 'Butter'],
                    ['amount' => null, 'unit' => '', 'name' => 'Koriander, frisch'],
                ],
            ], [
                'title' => 'Pfannkuchen',
                'method' => <<<TEXT
                                Mehl, Eier, Milch und eine Prise Salz zu einem glatten Teig verrühren und 30 Minuten quellen lassen.
        
                                Etwas Butter in einer Pfanne erhitzen und den Teig portionsweise hineingeben. Von beiden Seiten goldbraun backen. Nach Belieben mit Marmelade, Zucker oder Ahornsirup servieren.
                                TEXT,
                'categories' => ['Hauptgerichte'],
                'imagePath' => '/images/pfannkuchen-1792X1024.webp',
                'ingredients' => [
                    ['amount' => 250, 'unit' => 'g', 'name' => 'Mehl'],
                    ['amount' => 3, 'unit' => '', 'name' => 'Eier'],
                    ['amount' => 500, 'unit' => 'ml', 'name' => 'Milch'],
                    ['amount' => null, 'unit' => '', 'name' => 'Butter'],
                    ['amount' => null, 'unit' => '', 'name' => 'Salz'],
                ],
            ], [
                'title' => 'Zitronenlimonade',
                'method' => <<<TEXT
                                Die Zitronen auspressen und den Saft in eine Karaffe geben. Den Zucker in heißem Wasser auflösen und mit kaltem Wasser auffüllen.
        
                                Den Zitronensaft und den Zuckersirup in die Karaffe geben, gut umrühren und mit Eiswürfeln servieren.
                                TEXT,
                'categories' => ['Getränke'],
                'imagePath' => '/images/zitronenlimonade-1792X1024.webp',
                'ingredients' => [
                    ['amount' => 5, 'unit' => '', 'name' => 'Zitronen'],
                    ['amount' => 100, 'unit' => 'g', 'name' => 'Zucker'],
                    ['amount' => 1, 'unit' => 'l', 'name' => 'Wasser'],
                    ['amount' => null, 'unit' => '', 'name' => 'Eiswürfel'],
                ],
            ], [
                'title' => 'Schoko-Cookies',
                'method' => <<<TEXT
                                Die Butter mit dem Zucker schaumig rühren. Das Ei und den Vanillezucker hinzufügen und unterrühren. Das Mehl mit Backpulver und Salz mischen und zur Buttermischung geben. Zum Schluss die Schokostückchen unterheben.
        
                                Den Teig zu kleinen Kugeln formen und auf ein Backblech setzen. Bei 180 °C (Ober-/Unterhitze) 10-12 Minuten backen. Abkühlen lassen.
                                TEXT,
                'categories' => ['Desserts'],           
                'imagePath' => '/images/schoko-cookies-1792X1024.webp',
                'ingredients' => [
                    ['amount' => 150, 'unit' => 'g', 'name' => 'Butter'],
                    ['amount' => 100, 'unit' => 'g', 'name' => 'Zucker'],
                    ['amount' => 1, 'unit' => '', 'name' => 'Ei'],
                    ['amount' => 1, 'unit' => 'Päckchen', 'name' => 'Vanillezucker'],
                    ['amount' => 250, 'unit' => 'g', 'name' => 'Mehl'],
                    ['amount' => 1, 'unit' => 'TL', 'name' => 'Backpulver'],
                    ['amount' => null, 'unit' => '', 'name' => 'Salz'],
                    ['amount' => 150, 'unit' => 'g', 'name' => 'Schokostückchen'],
                ],
            ], [
                'title' => 'Brownies',
                'method' => <<<TEXT
                                Die Butter und die Schokolade in einem Wasserbad schmelzen. Zucker, Eier und eine Prise Salz hinzufügen und gut verrühren. Das Mehl unterheben, bis ein glatter Teig entsteht.
        
                                Den Teig in eine gefettete Form geben und bei 180 °C (Ober-/Unterhitze) 25-30 Minuten backen. Abkühlen lassen und in Stücke schneiden.
                                TEXT,
                'categories' => ['Desserts'],                                
                'imagePath' => '/images/brownies-1792X1024.webp',
                'ingredients' => [
                    ['amount' => 200, 'unit' => 'g', 'name' => 'Butter'],
                    ['amount' => 200, 'unit' => 'g', 'name' => 'Zartbitterschokolade'],
                    ['amount' => 250, 'unit' => 'g', 'name' => 'Zucker'],
                    ['amount' => 4, 'unit' => '', 'name' => 'Eier'],
                    ['amount' => 150, 'unit' => 'g', 'name' => 'Mehl'],
                    ['amount' => null, 'unit' => '', 'name' => 'Salz'],
                ],
            ], [
                'title' => 'Pina Colada',
                'method' => <<<TEXT
                                Den weißen Rum, die Kokosmilch und den Ananassaft in einen Mixer geben und gut durchmixen. Mit Eiswürfeln in ein Glas gießen und mit einer Ananasscheibe garnieren.
                                TEXT,
                'categories' => ['Getränke'],                                
                'imagePath' => '/images/pina-colada-1792X1024.webp',
                'ingredients' => [
                    ['amount' => 4, 'unit' => 'cl', 'name' => 'weißer Rum'],
                    ['amount' => 100, 'unit' => 'ml', 'name' => 'Kokosmilch'],
                    ['amount' => 200, 'unit' => 'ml', 'name' => 'Ananassaft'],
                    ['amount' => null, 'unit' => '', 'name' => 'Eiswürfel'],
                    ['amount' => null, 'unit' => '', 'name' => 'Ananasscheibe, zur Deko'],
                ],
            ],
        ];

        CategoryFactory::createSequence(
            [
                [
                    'title' => 'Hauptgerichte',
                    'imagePath' => '/images/hauptgerichte-1792X1024.webp'
                ], [
                    'title' => 'Desserts',
                    'imagePath' => '/images/desserts-1792X1024.webp'
                ], [
                    'title' => 'Getränke',
                    'imagePath' => '/images/getraenke-1792X1024.webp'
                ],
            ]
        );
        
        foreach ($recipesData as $recipeData) {
            $criteria = Criteria::create()
                ->where(Criteria::expr()->in('title', $recipeData['categories']));

            $recipe = RecipeFactory::createOne(
                [
                    'title' => $recipeData['title'],
                    'method' => $recipeData['method'],
                    'categories' => CategoryFactory::repository()->matching($criteria),
                    'imagePath' => $recipeData['imagePath'],
                ]
            );

            foreach ($recipeData['ingredients'] as $ingredient) {
                RecipeIngredientFactory::createOne([
                    'recipe' => $recipe,
                    'ingredient' => 
                        IngredientFactory::findOrCreate([
                            'name' => $ingredient['name']
                        ]),
                    'amount' => $ingredient['amount'],
                    'unit' => $ingredient['unit'],
                ]);
            };
        }

        $manager->flush();
    }
}