<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Form\CarFilterType;
use App\Repository\CarRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    #[Route('/nos_voitures', name: 'car_list')]
    public function carList(CarRepository $carRepository, Request $request): Response
    {
        $form = $this->createForm(CarFilterType::class);
        $form->handleRequest($request);

        $totalCars = $carRepository->totalCarCount();

        $cars = $carRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $filter = $form->getData();
            $cars = $carRepository->findCarsByFilter($filter);
        }

        return $this->render('car/list.html.twig', [
            "cars" => $cars,
            'filter_form' => $form->createView(),
            'total_cars' => $totalCars,
        ]);
    }

    #[Route('/filtered_cars', name: 'filtered_cars')]
    public function filteredCars(Request $request, CarRepository $carRepository): JsonResponse
    {
        $filter = $request->request->all();
        $cars = $carRepository->findCarsByFilter($filter);

        $carData = [];
        foreach ($cars as $car) {

            $images = $car->getCarImages();
            $firstImage = null;
            if (count($images) > 0) {
                $firstImage = $images[0]->getName();
            }

            $carData[] = [
                'price' => $car->getPrice(),
                'model' => $car->getModel(),
                'brand' => $car->getBrand(),
                'year' => $car->getYear(),
                'mileage' => $car->getMileage(),
                'horsepower' => $car->getHorsepower(),
                'energy' => $car->getEnergy(),
                'gearbox' => $car->getGearbox(),
                'doors' => $car->getDoors(),
                'image' => $firstImage,
                'detailLink' => $this->generateUrl('voiture_detail', ['id' => $car->getId()]),
            ];
        }

        return new JsonResponse([
            'car' => $carData,
        ]);
    }

    #[Route('/nos_voitures/{id}', name: "voiture_detail")]
    public function showDetails(Request $request, ManagerRegistry $doctrine, Car $car)
    {

        $contact = new Contact();

        $contact->setCar($car);

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($contact);
            $em->flush();

            $this->addFlash(
                'notice',
                'Votre demande de contact a bien été envoyée.'
            );

            return $this->redirectToRoute("voiture_detail", ['id' => $car->getId()]);
        }
        return $this->render('car/detail.html.twig', [
            'car' => $car,
            'contact_form' => $form->createView(),
        ]);
    }
}
