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
    public function modif(Request $request, EntityManagerInterface $em): string
    {
        $idEtat = $request->get('idEtat'); // récupère l'id de l'etat
        $idTache = $request->get('idTache'); // récupère l'id de la tache

        $tache = $em->getRepository(Tache::class)->find($idTache); // on récupère le repository de la tache 
        $etat = $em->getRepository(Etat::class)->find($idEtat); // on récupère le repository de la l'état

        if (!$tache) {
            throw $this->createNotFoundException(
                'Pas de tâche trouvée avec l\'id '.$idTache
            );
        } else{
            if (!$etat) {
                throw $this->createNotFoundException(
                    'Pas de tâche trouvée avec l\'id '.$idEtat
                );
            }

            $tache->setEtat($etat);
        }


        $em->persist($tache);
        $em->flush();

        // génération d'un message indiquant la prise en compte de la modification
        // $this->addFlash(
        //     'success',
        //     'Vous avez changé l\'état de la tâche ' . $tache->getTitre() . ' pour : ' . $tache->getEtat()
        // );

        
        return $this->json(['message' => 'Donnée enregistrée avec succès en base de données']);
    }
}
