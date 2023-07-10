<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Form\CarImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $car = new Car();
        $car->setUser($this->getUser());

        return $car;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('brand')->setLabel('Marque');

        yield TextField::new('model')->setLabel('Modèle');

        yield IntegerField::new('year')->setLabel('Année');

        yield IntegerField::new('mileage')->setLabel('Kilométrage');

        yield ChoiceField::new('energy')->setChoices([
            "Essence" => "Essence",
            "Gazole" => "Gazole",
            "Électrique" => "Électrique",
            "Hybride" => "Hybride",
        ])->setLabel('Énergie');

        yield ChoiceField::new('gearbox')->setChoices([
            "Manuelle" => "Manuelle",
            "Automatique" => "Automatique",
        ])->setLabel('Boîte de vitesses');

        yield ChoiceField::new('doors')->setChoices([
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        ])->setLabel('Nombre de portes');

        yield IntegerField::new('horsepower')->setLabel('Puissance (ch)');

        yield IntegerField::new('price')->setLabel("Prix");

        yield CollectionField::new('CarImages')->setLabel("Images")
        ->setEntryType(CarImageType::class);
    }
}
