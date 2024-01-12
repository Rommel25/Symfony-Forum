<?php

namespace App\Controller\Admin;

use App\Entity\Questionnaire;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuestionnaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Questionnaire::class;
    }




    public function configureFields(string $pageName): iterable
    {


        return [
            AssociationField::new('Question'),
            AssociationField::new('edition')
           ];
    }

}
