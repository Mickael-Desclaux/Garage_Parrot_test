<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\User;
use App\Entity\Review;
use App\Entity\Contact;
use App\Entity\HomeContent;
use App\Controller\Admin\CarCrudController;
use App\Entity\HomeServices;
use App\Entity\OpeningHours;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {        
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(CarCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Garage Parrot');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Accueil du site', 'fa fa-home', '/');

        if ($this->isGranted('ROLE_ADMIN')) {
        yield MenuItem::linkToCrud('Page d\'accueil', 'fa fa-list', HomeContent::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Prestations', 'fas fa-screwdriver-wrench', HomeServices::class);
        yield MenuItem::linkToCrud('Horaires', 'fas fa-clock', OpeningHours::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        }
        
        yield MenuItem::linkToCrud('Voitures', 'fas fa-car-side', Car::class);
        yield MenuItem::linkToCrud('Avis Clients', 'fas fa-star', Review::class);
        yield MenuItem::linkToCrud('Contacts', 'fas fa-envelope', Contact::class);
        yield MenuItem::linkToLogout('Déconnexion', 'fa-sharp fa-solid fa-circle-xmark');
    }
}
