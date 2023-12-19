<?php

namespace App\Controller\Admin;

use App\Entity\Atelier;
use App\Entity\Metier;
use App\Entity\Secteur;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AtelierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Atelier::class;
    }

    private $entityManager;

    // Injection de dépendance par le constructeur
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function configureFields(string $pageName): iterable
    {

        return [
            AssociationField::new('secteur'),
            AssociationField::new('salle'),
//            CollectionField::new('metier')

//            AssociationField::new('metier')->setCrudController(MetierCrudController::class)
        ];
    }

    private function getMetierChoices(array $metiers): array
    {
        $choices = [];

        foreach ($metiers as $metier) {
            // Adaptation selon la structure de vos objets Metier
            $choices[$metier->getId()] = $metier->getNom(); // Utilisez la méthode qui retourne la propriété que vous souhaitez afficher
        }

        return $choices;
    }


}
