<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('subject')->setLabel('Sujet');
        yield TextField::new('firstname')->setLabel('Prénom');
        yield TextField::new('lastname')->setLabel('Nom de famille');
        yield TextField::new('phone')->setLabel('Numéro de téléphone');
        yield TextField::new('email')->setLabel('Adresse E-Mail');
        yield TextareaField::new('message')->setLabel('Message');
    }
    
}
