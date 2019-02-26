<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evaluation;
use App\Entity\Movie;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class EvaluationController extends AbstractController
{
    /**
     * @Route("/evaluation", name="evaluation")
     */
    public function index()
    {
        return $this->render('evaluation/index.html.twig', [
            'controller_name' => 'EvaluationController',
        ]);
    }

    /**
     * @Route("/evaluation/{id}", name="evaluation")
     * @Isgranted("ROLE_ADMIN")
     */
    public function rate(Movie $b, Request $c)
    {
        $d = new Evaluation();

        $form = $this->createFormBuilder($d)
            ->add('comment')
            ->add('grade')
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $d.setMovie($b);
          $d.setUser($u);
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($d);
          $entityManager->flush();
        }

        return $this->render('movie/evaluation.html.twig', [
          "b" => $b,
          "form" => $form->createView()
        ]);
    }
}
