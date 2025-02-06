<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipe::class;
    }

    public function configureActions(Actions $actions): Actions {
        return $actions->setPermissions([
            Action::NEW => 'ROLE_ADMIN',
            Action::DELETE => 'ROLE_ADMIN',
            Action::SAVE_AND_RETURN => 'ROLE_ADMIN',
            Action::SAVE_AND_CONTINUE => 'ROLE_ADMIN',
            Action::SAVE_AND_ADD_ANOTHER => 'ROLE_ADMIN',
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('image', 'Bild')
                ->setBasePath('images')
                ->setUploadDir('public/images')
                ->setUploadedFileNamePattern('[slug].[extension]')
                ->setTextAlign('left'),
            TextField::new('title', 'Titel')
                /* ->setTemplatePath('admin/field/text.html.twig') */,
            TextareaField::new('method')->hideOnIndex(),
            CollectionField::new('recipeIngredients', 'Zutaten')->useEntryCrudForm()->hideOnIndex(),
            AssociationField::new('categories', 'Kategorien')->setFormTypeOption('by_reference', false)->onlyOnForms(),
            ArrayField::new('categories', 'Kategorien')->hideOnForm(),
            AssociationField::new('recipeTags', 'Tags')->setFormTypeOption('by_reference', false),
        ];
    }
}
