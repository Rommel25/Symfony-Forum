<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LyceeRepository;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\SecurityBundle\Security;

class MonitoringLyceeController extends AbstractController
{
    private $lyceeRepository;

    public function __construct(LyceeRepository $lyceeRepository)
    {
        $this->lyceeRepository = $lyceeRepository;
    }
    #[Route('/monitoring/lycee', name: 'app_monitoring_lycee')]
    #[IsGranted("ROLE_LYCEE")]
    public function index(Security $security): Response
    {
        $user = $security->getUser();

        $lyceeUsers = $this->profile($user);

        return $this->render('monitoring_lycee/index.html.twig', [
            'user' => $user,
            'lyceeUsers' => $lyceeUsers,
        ]);
    }

    public function profile($user)
    {
        // Récupérer le lycée associé à l'utilisateur courant
        $lyceeId = $user->getLycee();

        $lycee = $this->lyceeRepository->find($lyceeId);

        return $this->lyceeRepository->getLyceeUsers($lycee);
    }
}
