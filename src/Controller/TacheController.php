<?php

namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Tache;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TacheController extends AbstractController
{
    #[Route('/tache', name: 'app_tache')]
    public function index(): Response
    {
        return $this->render('tache/index.html.twig', [
            'controller_name' => 'TacheController',
        ]);
    }

    #[Route("/tache/modif", methods: ['POST'])]
    public function modif(Request $request, EntityManagerInterface $em): Response
    {
        if (!empty($request->get('idEtat')))
            $idEtat = $request->get('idEtat'); // récupère l'id de l'etat

        if (!empty($request->get('idTache')))
            $idTache = $request->get('idTache'); // récupère l'id de la tache

        $tache = $em->getRepository(Tache::class)->find($idTache); // on récupère le repository de la tache 
        $etat = $em->getRepository(Etat::class)->find($idEtat); // on récupère le repository de la l'état

        if (!$tache) {
            throw $this->createNotFoundException(
                'Pas de tâche trouvée avec l\'id ' . $idTache
            );
        } else {
            if (!$etat) {
                throw $this->createNotFoundException(
                    'Pas de tâche trouvée avec l\'id ' . $idEtat
                );
            } else $tache->setEtat($etat);
        }

        $em->persist($tache);
        $em->flush();

        if ($request->get("idEtat") === "3") {
            return $this->render('projet/modal.html.twig', []);
        } else
            return $this->json(['message' => 'Donnée enregistrée avec succès en base de données']);
    }
}
