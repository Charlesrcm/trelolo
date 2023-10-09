<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrioriteController extends AbstractController
{
    #[Route('/priorite', name: 'app_priorite')]
    public function index(): Response
    {
        return $this->render('priorite/index.html.twig', [
            'controller_name' => 'PrioriteController',
        ]);
    }
}
