<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
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
    
    public function configureFields(string $pageName): iterable
    {
        return [
            yield EmailField::new('email'),
            yield TextField::new('nom'),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!$entityInstance instanceof Utilisateur) return; // contrôle de l'envoi du formulaire

        $entityInstance->setIsAdmin(0); // faux de base car l'admin ne créé que des utilisateur avec le role -> user

        // si l'utilisateur créé n'est pas séléctionn
        if($entityInstance->isIsAdmin() === false)
            $entityInstance->setRoles(["ROLE_USER"]);
        
        parent::persistEntity($entityManager, $entityInstance);
    }
    
}
