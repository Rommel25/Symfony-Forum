<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    private $entityManager;

    // Injection de dépendance par le constructeur
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
//Permet de voir le profil de l'utilisateur
#[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
#[IsGranted("ROLE_USER")]
public function profile(Request $request, AuthenticationUtils $authenticationUtils, Security $security): Response
{
    return $this->render('general/profile.html.twig', [
        'user' => $security->getUser(),
        'date' => $security->getUser()->getDateInscription(),
    ]);
}

}