<?php

namespace App\Controller\Admin;

use App\Entity\Projet;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjetCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Projet::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $userId = $this->getUser()->getId();

        return [
            yield TextField::new('nom_projet', 'Nom du projet'),
            yield IdField::new('utilisateur')
                ->onlyOnForms() // pour avoir le champ uniquement lors de la création et de la modification 
                ->setFormTypeOption('disabled', true) // Empêche la modification du champ par l'utilisateur
                ->setFormTypeOption('attr', ['value' => $userId])
                ->hideOnForm(),
            yield DateField::new('d_creation', 'Date de création')->hideOnForm(),
            yield AssociationField::new('priorite', 'Priorité'),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Projet) return; // condition de vérification de l'objet envoyé

        $entityInstance->setUtilisateur($this->getUser()); // je passe en paramètre l'objet Utilisateur car il récupère l'id

        $entityInstance->setDCreation(new DateTime);

        parent::persistEntity($entityManager, $entityInstance); // pour flush le persistEntity
    }
}
