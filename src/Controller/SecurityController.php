<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegisterType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    private $entityManager;

    // Injection de dépendance par le constructeur
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    //Login fonctionne -> User vont vers index ou profile et admin va vers
    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);
        $userrepo = $this->entityManager->getRepository(User::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $mail = $formData->getEmail();
            $user = $userrepo->findOneBy(["email"=>$mail]);
//            dd(md5($formData->getPassword()), $user->getPassword());
            if(md5($formData->getPassword()) == $user->getPassword()){

                if ($user->getRoles() == ['ROLE_ADMIN']){

                    $token = new UsernamePasswordToken($user, "firewall", ["ROLE_ADMIN"], $user->getRoles());
                    $this->container->get('security.token_storage')->setToken($token);
                    return $this->redirectToRoute('app_admin', [$user]);
                }else{
                    $token = new UsernamePasswordToken($user, "firewall", ["ROLE_USER"], $user->getRoles());
                    $this->container->get('security.token_storage')->setToken($token);
                    return $this->redirectToRoute('app_index');
                }

            }
        }
        // render login form
        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    #[Route('/logout', name: 'app_logout', methods: ['GET', 'POST'])]
    public function logout()
    {
        // laisser vide
    }

    //Création de compte
    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(md5($user->getPassword()));
            $user->setRoles(["ROLE_USER"]);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
