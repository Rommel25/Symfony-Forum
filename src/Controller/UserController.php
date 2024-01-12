<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Entity\Questionnaire;
use App\Entity\User;
use App\Form\LoginType;
use App\Form\QuestionnaireType;
use App\Repository\LyceenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\QuestionnaireRepository;

class UserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, private LyceenRepository $lyceenRepository)
    {
        $this->entityManager = $entityManager;
    }
//Permet de voir le profil de l'utilisateur
#[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
#[IsGranted("ROLE_USER")]
public function profile(Request $request, AuthenticationUtils $authenticationUtils, Security $security): Response
{   $lyceen = $this->lyceenRepository->findOneBy(['user'=>$security->getUser()]);
    return $this->render('general/profile.html.twig', [
        'user' => $security->getUser(),
        'lyceen' => $lyceen

    ]);
}

    #[Route('/questionnaire', name: 'app_questionnaire', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_USER")]
    public function questionnaire(Request $request, AuthenticationUtils $authenticationUtils, Security $security, QuestionnaireRepository $questionnaireRepository): Response
    {
        $questionnaire = $questionnaireRepository->findLast();
        $form = $this->createForm(QuestionnaireType::class, null, [
            'questionnaire' => $questionnaire
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            foreach($form->getData() as $reponse){
                $this->entityManager->persist($reponse);
            };
            $this->entityManager->flush();
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('lyceen/questionnaire.html.twig', [
            'form' => $form,
        ]);
    }

}