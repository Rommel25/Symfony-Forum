<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Repository\AtelierRepository;
use App\Repository\LyceenRepository;
use App\Repository\SponsorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class AtelierController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager, private SponsorRepository $sponsorRepository)
    {
    }


    #[Route('/', name: 'app_atelier')]
    public function index(AtelierRepository $atelierRepository): Response
    {
        // Fetch all ateliers from the repository
        $ateliers = $atelierRepository->findAll();

        return $this->render('atelier/index.html.twig', [
            'ateliers' => $ateliers,
            'sponsor' => $this->sponsorRepository->findLast()
        ]);
    }

    #[Route('/atelier/{id}', name: 'app_atelier_id')]
    public function oneAtelier(AtelierRepository $atelierRepository, Atelier $atelier): Response
    {
        // Fetch all ateliers from the repository
//        $ateliers = $atelierRepository->findAll();

        return $this->render('atelier/oneAtelier.html.twig', [
            'atelier' => $atelier,
            'sponsor' => $this->sponsorRepository->findLast()

        ]);
    }

    #[Route('/inscription-atelier/{id}', name: 'inscription_atelier')]
    #[IsGranted("ROLE_USER")]
    public function inscriptionAtelier(Request $request, Atelier $atelier, LyceenRepository $lyceenRepository, SessionInterface $session): Response
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

            $session->getFlashBag()->add('success', 'L\'atelier a bien été ajouté.');
            return $this->redirectToRoute('app_atelier');
        }
        else{
            $session->getFlashBag()->add('error', 'Vous avez deja 3 ateliers');
            return $this->redirectToRoute('app_atelier');
        }
    }

}
