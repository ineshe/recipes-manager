<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipe::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            ImageField::new('image', 'Bild')
                ->setBasePath('images')
                ->setUploadDir('public/images')
                ->setUploadedFileNamePattern('[slug].[extension]')
                ->setTextAlign('left'),
            TextField::new('title'),
            TextareaField::new('method')->hideOnIndex(),
            CollectionField::new('recipeIngredients', 'Zutaten')->useEntryCrudForm()->hideOnIndex(),
            // CollectionField::new('recipeIngredients', 'Zutaten')->setEntryType(RecipeIngredientType::class),
            // CollectionField::new('categories', 'Kategorien')->useEntryCrudForm(),
            AssociationField::new('categories', 'Kategorien')->setFormTypeOption('by_reference', false),
        ];
    }
}
