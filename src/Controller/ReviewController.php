<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ReviewRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewController extends AbstractController
{
    #[Route('/vos_avis', name: 'review')]
    public function newReview(Request $request, ManagerRegistry $doctrine, ReviewRepository $reviewRepository): Response
    {
        $review = new Review();
        $review->setApproved(false);

        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($review);
            $em->flush();

            $this->addFlash(
                'notice',
                'Votre avis a été publié, il sera affiché sur le site après validation du personnel!'
            );

            return $this->redirectToRoute("review");
        }

        $reviewRepository = $doctrine->getRepository(Review::class);
        $reviews = $reviewRepository->findBy(
            ['approved' => true],
        );

        return $this->render('review/form.html.twig', [
            "review_form" => $form->createView(),
            "reviews" => $reviews
        ]);
    }
}
