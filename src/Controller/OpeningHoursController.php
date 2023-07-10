<?php

namespace App\Controller;

use App\Entity\OpeningHours;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OpeningHoursController extends AbstractController
{
    #[Route('/opening/hours', name: 'app_opening_hours')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(OpeningHours::class);
        $opening = $repository->findAll();

        return $this->render('base.html.twig', [
            "opening" => $opening,
        ]);
    }
}
