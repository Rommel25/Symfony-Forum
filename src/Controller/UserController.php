<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Entity\Questionnaire;
use App\Entity\Sponsor;
use App\Entity\User;
use App\Form\LoginType;
use App\Form\QuestionnaireType;
use App\Repository\LyceenRepository;
use App\Repository\SponsorRepository;
use App\Service\EncryptDataService;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\QuestionnaireRepository;

class UserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, private LyceenRepository $lyceenRepository,
    private EncryptDataService $encryptDataService, private SponsorRepository $sponsorRepository)
    {
        $this->entityManager = $entityManager;
    }
//Permet de voir le profil de l'utilisateur
#[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
#[IsGranted("ROLE_USER")]
public function profile(Request $request, AuthenticationUtils $authenticationUtils, Security $security): Response
{   $lyceen = $this->lyceenRepository->findOneBy(['user'=>$security->getUser()]);
//    dd($lyceen->getAteliers());
    return $this->render('lyceen/profile.html.twig', [
        'user' => $security->getUser(),
        'lyceen' => $lyceen,
        'ateliers' => $lyceen->getAteliers(),
        'sponsor' => $this->sponsorRepository->findLast()

    ]);
}

    #[Route('/questionnaire', name: 'app_questionnaire', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_USER")]
    public function questionnaire(Request $request, AuthenticationUtils $authenticationUtils, Security $security, QuestionnaireRepository $questionnaireRepository, SessionInterface $session): Response
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
            $lyceen = $this->lyceenRepository->findOneBy(['user'=>$this->getUser()]);
//            $this->encryptDataService->hashService($lyceen);
            $session->getFlashBag()->add('success', 'Vos réponses ont bien été enregistrés');
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('lyceen/questionnaire.html.twig', [
            'form' => $form,
            'sponsor' => $this->sponsorRepository->findLast()
        ]);
    }



}