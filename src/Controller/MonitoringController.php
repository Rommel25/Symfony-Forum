<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Repository\AtelierRepository;
use App\Repository\LyceeRepository;
use App\Repository\SponsorRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MonitoringController extends AbstractController
{
    #[Route('/monitoring/lycee', name: 'app_monitoring_lycee')]
    #[IsGranted('ROLE_LYCEE')]
    public function index(Security $security, LyceeRepository $lyceeRepository, UserRepository $userRepository, SponsorRepository $sponsorRepository): Response
    {
        $user = $userRepository->findOneBy(['id'=>$security->getUser()->getId()]);
//        dd($user);
        $lycee = $lyceeRepository->findLyceeByUserAdmin($user);


        return $this->render('monitoring/lycee.html.twig', [
            'lyceens' => $lycee->getlyceen(),
            'sponsor' => $sponsorRepository->findLast()

        ]);
    }
    #[Route('/monitoring/atelier/{id}', name: 'app_monitoring_lycee')]
    #[IsGranted('ROLE_ADMIN')]
    public function ateliersMonitoring(Atelier $atelier): Response {

        return $this->render('monitoring/atelier.html.twig', [
            'atelier' => $atelier,
        ]);
    }

}
