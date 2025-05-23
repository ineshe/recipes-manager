<?php

namespace App\Controller\Admin;

use App\Entity\StepIngredient;
use Doctrine\ORM\QueryBuilder;
use App\Entity\RecipeIngredient;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StepIngredientCrudController extends AbstractCrudController
{
    private EntityRepository $recipeIngredientRepository;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->recipeIngredientRepository = $entityManager->getRepository(RecipeIngredient::class);
    }

    public static function getEntityFqcn(): string
    {
        return StepIngredient::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $currentRecipe = $this->getContext()->getEntity()->getInstance();

        return [
            AssociationField::new('recipeIngredient', 'Zutat')
                ->setQueryBuilder(function (QueryBuilder $qb) use ($currentRecipe) {
                    $qb
                        ->andWhere('entity.recipe = :recipe')
                        ->setParameter('recipe', $currentRecipe);
                })
                ->setFormTypeOptions([
                    'choice_attr' => function($ingredient) {
                        return [
                            'data-amount' => $ingredient->getAmount(),
                            'data-unit'   => $ingredient->getUnit(),
                        ];
                    }
                ]),
            NumberField::new('amount', 'Menge'),
            TextField::new('unit', 'Einheit'),
        ];
    }
}
