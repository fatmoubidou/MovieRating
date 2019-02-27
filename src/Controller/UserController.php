<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Evaluation;

class UserController extends AbstractController
{
    /**
     * @Route("/account", name="account")
     */
    public function index()
    {
        $evaluations = $this->getDoctrine()->getRepository(Evaluation::class)->findEvaluationsByUser($this->getUser());
        return $this->render('user/index.html.twig', [
            'evaluations' => $evaluations,
            'user' => $this->getUser(),
        ]);
    }
}
