<?php

namespace App\Controller\Admin;

use App\Entity\Billet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BilletCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Billet::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('visiteur')->setCrudController(UserCrudController::class),
            DateField::new('dateAchat'),
            DateField::new('dateReservation'),
            TextField::new('type'),
        ];
    }
}
