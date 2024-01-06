<?php

namespace App\Controller\Admin;

use App\Entity\Intervenant;
use Cassandra\Type\UserType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\CrudFormType;

class IntervenantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Intervenant::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user')->renderAsEmbeddedForm(),
            TextField::new('entreprise'),
            AssociationField::new('atelier')
            ];
    }

}
