<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MonitoringLyceeController extends AbstractController
{
    #[Route('/monitoring/lycee', name: 'app_monitoring_lycee')]
    public function index(): Response
    {
        return $this->render('monitoring_lycee/index.html.twig', [
            'controller_name' => 'MonitoringLyceeController',
        ]);
    }
}
