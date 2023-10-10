<?php

namespace App\Controller\Admin;

use App\Entity\Projet;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Psr\Log\LoggerInterface;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class ProjetCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Projet::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        

        return [
            yield TextField::new('nom_projet', 'Nom du projet'),
            yield HiddenField::new('utilisateur_id.id')->onlyOnForms(),
            yield DateField::new('d_creation', 'Date de création'),
            yield AssociationField::new('priorite', 'Priorité'),
        ];
    }
    
}
