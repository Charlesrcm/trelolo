<?php

namespace App\Controller\Admin;

use App\Entity\Tache;
use App\Entity\Utilisateur;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TacheCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tache::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('titre', 'Nom de la tâche'),
            yield TextField::new('description', 'Description de la tache'),
            yield AssociationField::new('etat', 'Etat de la tache'),
            yield AssociationField::new('projet', 'Associer à quel projet ?'),
            yield AssociationField::new('utilisateur', 'Choisir un utilisateur')
            // ->setQueryBuilder(
            //     fn (QueryBuilder $QueryBuilder) => $QueryBuilder->getEntityManager()->getRepository(Utilisateur::class)->findOneBySomeField()
            // )
        ];
    }
}
