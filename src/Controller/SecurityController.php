<?php

namespace App\Controller;

use App\Entity\Lyceen;
use App\Entity\User;
use App\Form\LoginType;
use App\Form\LyceenType;
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
            $user = $userrepo->findOneBy(["email" => $mail]);
//                        dd($formData->getPassword(), $user->getPassword());
            if ($formData->getPassword() == $user->getPassword()) {
//                dd('test');
                if ($user->getRoles() == ['ROLE_ADMIN']) {

                    $token = new UsernamePasswordToken($user, "firewall", ["ROLE_ADMIN"], $user->getRoles());
                    $this->container->get('security.token_storage')->setToken($token);
                    return $this->redirectToRoute('admin', [$user]);
                } elseif ($user->getRoles() == ['ROLE_LYCEE']) {
                    $token = new UsernamePasswordToken($user, "firewall", ["ROLE_LYCEE"], $user->getRoles());
                    $this->container->get('security.token_storage')->setToken($token);
                    return $this->redirectToRoute('app_atelier');
                } else {
                    $token = new UsernamePasswordToken($user, "firewall", ["ROLE_USER"], $user->getRoles());
                    $this->container->get('security.token_storage')->setToken($token);
                    return $this->redirectToRoute('app_atelier');
                }
            }
        }
        // render login form
        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/deconnexion', name: 'logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


    //Création de compte
    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request): Response
    {
        $lyceen = new Lyceen();
        $form = $this->createForm(LyceenType::class, $lyceen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lyceen->getUser()->setPassword(md5($lyceen->getUser()->getPassword()));
            $lyceen->getUser()->setRoles(["ROLE_USER"]);
            $this->entityManager->persist($lyceen);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
