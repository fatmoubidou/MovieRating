<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Movie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class MovieController extends AbstractController
{

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


}
