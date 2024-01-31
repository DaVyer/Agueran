<?php

namespace App\Controller\Admin;

use App\Entity\Reserver;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ReserverCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reserver::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('activite')->setCrudController(ActiviteCrudController::class),
            AssociationField::new('user')->setCrudController(UserCrudController::class),
            DateField::new('dateReservation'),
            IntegerField::new('nbvisiteurs'),
        ];
    }
}
