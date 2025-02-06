<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
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
            TextField::new('name'),
        ];
    }
}
