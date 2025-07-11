<?php

namespace App\Controller\Admin;

use App\Entity\Step;
use App\Service\StepPositionService;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StepCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Step::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            CollectionField::new('stepIngredients', 'Zutaten')->useEntryCrudForm()->hideOnIndex(),
            TextareaField::new('instruction', 'Beschreibung'),
        ];
    }
}
