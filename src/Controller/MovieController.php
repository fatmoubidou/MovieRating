<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Movie;
use App\Entity\Evaluation;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class MovieController extends AbstractController
{


    /**
     * fonction fète pr tester ds trucs
     * @Route("/test", name="test")
     */
    public function test()
    {
        // $ms = $this->getDoctrine()->getRepository(Movie::class)->findAll();
        // //fonction qui essé de calc moyen note flm mais prblm
        // for ($i=0; $i < count($ms) ; $i) {
        //   $notes = $ms[$i]->getEvaluations()->getGrade();
        // }
        // return $this->render('test/index.html.twig', [
        //   "ms" => $ms
        // ]);
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $movies = $this->getDoctrine()->getRepository(Movie::class)->findAll();
        return $this->render('index.html.twig', [
          "movies" => $movies
        ]);
    }

    /**
     * @Route("/single/{id}", name="single", requirements={"id"="\d+"})
     */
    public function show($id)
    {
        $movie = $this->getDoctrine()->getRepository(Movie::class)->find($id);
        return $this->render('movie/single.html.twig', [
          "movie" => $movie
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

        return $this->render('test/evaluation.html.twig', [
          "b" => $b,
          "form" => $form->createView()
        ]);
    }
}
