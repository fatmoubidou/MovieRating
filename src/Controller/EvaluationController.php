<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evaluation;
use App\Entity\Movie;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Require ROLE_ADMIN for *every* controller method in this class.
 *
 * @Route("/evaluation")
 */
class EvaluationController extends AbstractController
{
    /**
     * @Route("/evaluation/{id}", name="evaluation", requirements={"id"="\d+"})
     * @IsGranted("ROLE_ADMIN")
     *
     */
    public function rate(Movie $movie, Request $request)
    {
        $evaluation = new Evaluation();

        $form = $this->createFormBuilder($evaluation)
            ->add('comment')
            ->add('grade')
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          // to make sure the user is authenticated first
          $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

          // returns User object, or null if the user is not authenticated
          $user = $this->getUser();

          $evaluation->setMovie($movie);
          $evaluation->setUser($user);
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($evaluation);
          $entityManager->flush();
        }

        return $this->render('movie/evaluation.html.twig', [
          'movie' => $movie,
          'form' => $form->createView()
        ]);
    }
}
