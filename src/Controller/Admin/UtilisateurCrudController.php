<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UtilisateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     return $actions
    //         // ->remove(Crud::PAGE_INDEX, Action::NEW)
    //         // ->remove(Crud::PAGE_INDEX, Action::EDIT);
    //         // ->remove(Crud::PAGE_INDEX, Action::DELETE)
    //         // ->remove(Crud::PAGE_DETAIL, Action::EDIT);

    // }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            yield EmailField::new('email'),
            yield TextField::new('nom'),
            yield ChoiceField::new('roles'),
            yield BooleanField::new('is_admin')
        ];
    }
    
}
