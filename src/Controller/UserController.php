<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Evaluation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



class UserController extends AbstractController
{
    /**
     * @Route("/account", name="account")
     * @IsGranted("ROLE_USER")
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
