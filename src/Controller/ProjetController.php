<?php

namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Projet;
use App\Entity\Utilisateur;
use App\Form\ProjetFormType;
use App\Repository\EtatRepository;
use App\Repository\PrioriteRepository;
use App\Repository\ProjetRepository;
use App\Repository\TacheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProjetController extends AbstractController
{
    #[Route('/projet', name: 'app_projet')]
    public function index(PrioriteRepository $prioriteRepository, ProjetRepository $projetRepository, TacheRepository $tacheRepository, EtatRepository $etatRepository): Response
    {

        // récupère les priorités
        $prioriteListe = $prioriteRepository->findAll();
        // récupère tous les projets
        $projetListe = $projetRepository->findAll();
        // récupère toutes les tâches
        $tacheListe = $tacheRepository->findAll();
        // récupère les états
        $etatListe = $etatRepository->findAll();

        // dd($tacheListe);
        return $this->render('projet/index.html.twig', [
            'controller_name' => 'ProjetController',
            'prioriteListe' => $prioriteListe,
            'projetListe' => $projetListe,
            'tacheListe' => $tacheListe,
            'etatListe' => $etatListe,
        ]);
    }

    #[Route("/newProjet", name: "new_projet")]
    public function newProjet(Request $request, ProjetRepository $projetRepository): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetFormType::class, $projet);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $projetRepository->add($projet, true);

            return $this->redirectToRoute('app_projet');
        }

        return $this->render('projet/newProjet.html.twig', [
            'form_projet' => $form->createView(),
        ]);
    }
}
