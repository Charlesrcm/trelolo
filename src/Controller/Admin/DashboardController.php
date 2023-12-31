<?php

namespace App\Controller\Admin;

use App\Entity\Etat;
use App\Entity\Priorite;
use App\Entity\Projet;
use App\Entity\Tache;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        if (!$this->getUser() || $this->getUser()->getRoles()[0] === "ROLE_USER")
            return $this->redirectToRoute('app_projet');

        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // utilise le projetController
        return $this->redirect($adminUrlGenerator->setController(ProjetCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Trelolo');
    }

    public function configureMenuItems(): iterable
    {
        // le label, l'icone et l'entité
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Projets', 'fas fa-list', Projet::class);
        yield MenuItem::linkToCrud('Tache', 'fas fa-list', Tache::class);
        yield MenuItem::linkToCrud('Etat', 'fas fa-list', Etat::class);
        yield MenuItem::linkToCrud('Priorite', 'fas fa-list', Priorite::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', Utilisateur::class);
        yield MenuItem::linkToRoute('Retour au site', 'fas fa-list', 'app_projet');
    }
}
