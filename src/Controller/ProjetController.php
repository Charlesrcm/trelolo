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

    #[Route("/projet/prio", methods: ["POST"])]
    public function modif(Request $request, EntityManagerInterface $em): Response
    {
        if (!empty($request->get('idSection'))) {
            $idPrio = $request->get('idSection'); // on récupère l'id de la priorité contenu dans la section
            if (preg_match('/(\d+)/', $idPrio, $matches)) {
                $idPrio = $matches[0]; // grâce à preg_match, on récupère l'id de la priorité
            }
        }

        if (!empty($request->get('idProjet'))) {
            $idProjet = $request->get('idProjet'); // on récupère l'id du projet
            if (preg_match('/(\d+)/', $idProjet, $matches)) {
                $idProjet = $matches[0]; // grâce à preg_match, on récupère l'id du projet en base
            }
        }

        $projet = $em->getRepository(Projet::class)->find($idProjet);
        $priorite = $em->getRepository(Priorite::class)->find($idPrio);

        if (!$priorite) {
            throw $this->createNotFoundException(
                'Pas de priorité trouvée avec l\'id ' . $idPrio
            );
        } else {
            if (!$projet) {
                throw $this->createNotFoundException(
                    'Pas de projet trouvé avec l\'id ' . $idProjet
                );
            } else $projet->setPriorite($priorite);
        }

        $em->persist($projet);
        $em->flush();

        return $this->json(["message" => "Le projet " . $projet . " est devenu : " . $priorite]);
    }
}
