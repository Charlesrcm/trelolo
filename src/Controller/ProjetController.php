<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetFormType;
use App\Repository\PrioriteRepository;
use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProjetController extends AbstractController
{
    #[Route('/projet', name: 'app_projet')]
    public function index(PrioriteRepository $prioriteRepository): Response
    {

        $prioriteListe = $prioriteRepository->findAll();

        return $this->render('projet/index.html.twig', [
            'controller_name' => 'ProjetController',
            "prioriteListe" => $prioriteListe,
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
