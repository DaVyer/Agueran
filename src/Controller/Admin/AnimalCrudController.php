<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AnimalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animal::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('famille')->setCrudController(FamilleCrudController::class),
            AssociationField::new('enclos')->setCrudController(EnclosCrudController::class),
            AssociationField::new('categorie')->setCrudController(CategorieCrudController::class),
            TextField::new('nomAnimal'),
            TextField::new('lieuOriginaireAnimal'),
            TextField::new('descAnimal'),
        ];
    }
}
