<?php

// AtelierController.php

namespace App\Controller;

use App\Entity\Atelier;
use App\Repository\AtelierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AtelierController extends AbstractController
{
    #[Route('/atelier', name: 'app_atelier')]
    public function index(AtelierRepository $atelierRepository): Response
    {
        // Fetch all ateliers from the repository
        $ateliers = $atelierRepository->findAll();

        return $this->render('atelier/index.html.twig', [
            'ateliers' => $ateliers,
        ]);
    }

    #[Route('/atelier/{id}', name: 'app_atelier_id')]
    public function oneAtelier(AtelierRepository $atelierRepository, Atelier $atelier): Response
    {
        // Fetch all ateliers from the repository
//        $ateliers = $atelierRepository->findAll();

        return $this->render('atelier/oneAtelier.html.twig', [
            'atelier' => $atelier,
        ]);
    }

    #[Route('/inscription-atelier/{id}', name: 'inscription_atelier')]
    public function inscriptionAtelier(Request $request, Atelier $atelier): Response
    {
        $lyceen = $this->getUser();

        $atelier->addLyceen($lyceen);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($atelier);
        $entityManager->flush();
        
        return $this->redirectToRoute('app_atelier');
    }

}

