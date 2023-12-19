<?php

namespace App\Controller\Admin;

use App\Entity\Atelier;
use App\Entity\Ressources;
use App\Entity\Secteur;
use App\Entity\Sponsor;
use App\Entity\Salle;
use App\Entity\Metier;
use App\Entity\Question;
use App\Entity\Questionnaire;
use App\Entity\IntervenantEdition;
use App\Entity\Lycee;
use App\Entity\Edition;
use App\Entity\User;
use App\Entity\Intervenant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
               $url = $routeBuilder->setController(AtelierCrudController::class)->generateUrl();

               return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfony Forum');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Ateliers', 'fas fa-comments', Atelier::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Edition', 'fas fa-edit', Edition::class);
        yield MenuItem::linkToCrud('Intervenant', 'fas fa-user', Intervenant::class);
        // yield MenuItem::linkToCrud('IntervenantEdition', 'fas fa-user', IntervenantEdition::class);
        yield MenuItem::linkToCrud('Lycées', 'fas fa-school', Lycee::class);
        yield MenuItem::linkToCrud('Métiers', 'fas fa-briefcase', Metier::class);
        yield MenuItem::linkToCrud('Questions', 'fas fa-question', Question::class);
        yield MenuItem::linkToCrud('Questionnaire', 'fas fa-question', Questionnaire::class);
        yield MenuItem::linkToCrud('Ressources', 'fas fa-book', Ressources::class);
        yield MenuItem::linkToCrud('Salles', 'fas fa-question', Salle::class);
        yield MenuItem::linkToCrud('Secteurs', 'fas fa-vector-square', Secteur::class);
        yield MenuItem::linkToCrud('Sponsors', 'fas fa-copyright', Sponsor::class);
    }
}
