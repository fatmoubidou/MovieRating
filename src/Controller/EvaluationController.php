<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evaluation;
use App\Entity\Movie;
use App\Entity\User;
use App\Form\EvaluationType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



class EvaluationController extends AbstractController
{
    /**
     * @Route("/evaluation/{id}", name="evaluation", requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER")
     *
     */
    public function rate(Movie $movie, Request $request)
    {
        $evaluation = new Evaluation();

        $form = $this->createForm(EvaluationType::class, $evaluation);
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
          return $this->redirectToRoute('single',['id'=>$movie->getId()]);
        }

        return $this->render('movie/evaluation.html.twig', [
          'movie' => $movie,
          'evaluationForm' => $form->createView()
        ]);
    }


    /**
     * @Route("/evaluation/{id}/edit", name="evaluationEdit", requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER")
     *
     */
    public function edit(Evaluation $evaluation, Request $request)
    {
        $form = $this->createForm(EvaluationType::class, $evaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('account');
        }

        return $this->render('movie/evaluation.html.twig', [
            'evaluation' => $evaluation,
            'movie' => $evaluation->getMovie(),
            'evaluationForm' => $form->createView(),
        ]);
    }
}
