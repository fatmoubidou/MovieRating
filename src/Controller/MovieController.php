<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Movie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class MovieController extends AbstractController
{


    /**
     * fonction fète pr tester ds trucs
     * @Route("/test", name="test")
     */
    // public function test()
    // {
    //     $movies = $this->getDoctrine()->getRepository(Movie::class)->findAll();
    //     //fonction qui essé de calc moyen note flm mais prblm
    //     for ($i=0; $i < count($movies) ; $i) {
    //       $grade = $movies[$i]->getEvaluations()->getGrade();
    //     }
    //     return $this->render('movie/index.html.twig', [
    //       'movies' => $movies,
    //
    //     ]);
    // }

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
        //$evaluations = $this->getDoctrine()->getRepository(Evaluation::class)->findOneBy(['movie'=>$movie]);

        return $this->render('movie/single.html.twig', [
          "movie" => $movie
        ]);
    }


}
