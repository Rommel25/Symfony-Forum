<?php

namespace App\Controller;

use App\Entity\Atelier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class ListeAteliersController extends AbstractController
{
    #[Route('/liste/ateliers', name: 'app_liste_ateliers')]
    public function index(): Response
    {
        $userrepo = $this->entityManager->getRepository(Atelier::class);
        $Atelier = $userrepo->findAll();
        return $this->render('liste_ateliers/index.html.twig', [
            'controller_name' => 'ListeAteliersController',
        ]);
    }
    private $entityManager;

    // Injection de dépendance par le constructeur
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}


  