<?php

namespace App\Controller;

use App\Entity\HomeContent;
use App\Entity\HomeServices;
use App\Entity\Review;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(HomeContent::class);
        $content = $repository->findBy([], ['displayOrder' => 'ASC']);

        $servicesRepository = $doctrine->getRepository(HomeServices::class);
        $services = $servicesRepository->findAll();

        $reviewRepository = $doctrine->getRepository(Review::class);
        $reviews = $reviewRepository->findBy(
            ['approved' => true],
            null,
            10
        );

        return $this->render('home/index.html.twig', [
            "content" => $content,
            "reviews" => $reviews,
            "services" => $services
        ]);
    }
}
