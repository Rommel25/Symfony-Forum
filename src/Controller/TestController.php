<?php

namespace App\Controller;

use App\Entity\User;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class TestController extends AbstractController
{

    #[Route('/index', name: 'app_index', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('general/index.html.twig');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        // laisser vide
    }

//    /**
//     * @Route("/register", name="app_register")
//     */
//    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
//    {
//        $user = new User();
//        $form = $this->createForm(RegistrationFormType::class, $user);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($user);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('app_login');
//        }
//
//        return $this->render('registration/register.html.twig', [
//            'registrationForm' => $form->createView(),
//        ]);
//    }
}
