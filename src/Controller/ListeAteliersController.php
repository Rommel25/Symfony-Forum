<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeAteliersController extends AbstractController
{
    #[Route('/liste/ateliers', name: 'app_liste_ateliers')]
    public function index(): Response
    {
        return $this->render('liste_ateliers/index.html.twig', [
            'controller_name' => 'ListeAteliersController',
        ]);
    }
}
