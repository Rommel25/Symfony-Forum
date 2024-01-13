<?php

// AtelierController.php

namespace App\Controller;

use App\Entity\Atelier;
use App\Repository\LyceenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AtelierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AtelierController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }


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
    public function inscriptionAtelier(Request $request, Atelier $atelier, LyceenRepository $lyceenRepository): Response
    {
        $user = $this->getUser();
        $lyceen = $lyceenRepository->findOneBy(['user'=>$user]);
//        dd($lyceen);
    if($lyceen->getAteliers()->count() < 3){
        $atelier->addLyceen($lyceen);
        $lyceen->addAtelier($atelier);

//        $entityManager = $this->getDoctrine()->getManager();
        $this->entityManager->persist($atelier);
        $this->entityManager->persist($lyceen);
        $this->entityManager->flush();
    }
    else{
        return $this->redirectToRoute('app_profile');
    }


        return $this->redirectToRoute('app_atelier');
    }

}

