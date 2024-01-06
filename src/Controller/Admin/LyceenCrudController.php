<?php

namespace App\Controller\Admin;

use App\Entity\Lyceen;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LyceenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lyceen::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('Lycee'),
            AssociationField::new('user')->renderAsEmbeddedForm(),
            AssociationField::new('ateliers')
        ];
    }

}
