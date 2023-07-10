<?php

namespace App\Controller\Admin;

use App\Entity\HomeServices;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HomeServicesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HomeServices::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title')->setLabel('Titre');
        yield TextareaField::new('content')->setLabel('Description');
        yield NumberField::new('price')
            ->setLabel('Prix')
            ->setNumDecimals('2');
        yield ImageField::new('image')
            ->setUploadDir('public/images/home/services')
            ->setLabel('Image');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_ADMIN');
    }
}
