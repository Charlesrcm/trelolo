<?php

namespace App\Controller;

use App\Form\UtilisateurFormType;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(Request $request, UtilisateurRepository $utilisateurRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $this->getUser();
        $plainPWD = $request;
        dd($request);

        $form = $this->createForm(UtilisateurFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $utilisateurRepository->add($user, true);
        }

        return $this->render('utilisateur/index.html.twig', [
            'user' => $user,
            'form_user' => $form->createView(),
        ]);
    }
}
