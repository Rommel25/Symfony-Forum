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

#[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
#[IsGranted("ROLE_USER")]
public function profile(Request $request, AuthenticationUtils $authenticationUtils, Security $security): Response
{
    dd($security->getUser());

    if ($form->isSubmitted() && $form->isValid()) {
        $formData = $form->getData();
        $mail = $formData->getEmail();
        $user = $userrepo->findOneBy(["email"=>$mail]);
        if(md5($formData->getPassword()) == $user->getPassword()){
            if ($user->getRoles() == ['ROLE_ADMIN', 'ROLE_USER']){
                return $this->redirectToRoute('app_admin');
            }else{
                return $this->redirectToRoute('app_index');
            }

        }
    }
    // render login form
    return $this->render('security/login.html.twig', [
        'form' => $form->createView(),
    ]);
}

}