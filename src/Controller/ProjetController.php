<?php

namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Priorite;
use App\Entity\Projet;
use App\Entity\Tache;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProjetController extends AbstractController
{
    #[Route('/projet', name: 'app_projet')]
    public function index(EntityManagerInterface $em,): Response
    {
        // récupère les priorités
        $prioriteListe = $em->getRepository(Priorite::class)->findAll();
        // récupère tous les projets
        $projetListe = $em->getRepository(Projet::class)->findAll();
        // récupère toutes les tâches
        $tacheListe = $em->getRepository(Tache::class)->findAll();
        // récupère les états
        $etatListe = $em->getRepository(Etat::class)->findAll();

        return $this->render('projet/index.html.twig', [
            'controller_name' => 'ProjetController',
            'prioriteListe' => $prioriteListe,
            'projetListe' => $projetListe,
            'tacheListe' => $tacheListe,
            'etatListe' => $etatListe,
        ]);
    }
}
