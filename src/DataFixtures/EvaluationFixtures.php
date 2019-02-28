<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Evaluation;
use App\Entity\Movie;
use App\Entity\User;
use Faker;

class EvaluationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      // $movies = $this->getDoctrine()->getRepository(Movie::class)->findAll();
      // $users = $this->getDoctrine()->getRepository(User::class)->findAll();
      //
      // $faker = Faker\Factory::create('fr_FR');
      //
      // for ($i=0; $i < 10; $i++) {
      //   $evaluation = new Evaluation();
      //   $evaluation->setGrade($faker->randomDigit());
      //   $evaluation->setComment($faker->text($maxNbChars = 400));
      //   $evaluation->setEvalDate($faker->dateTime($max = 'now'));
      //   $evaluation->setMovie($movies[rand(0, 20)]);
      //   $evaluation->setUser($users[rand(0, 10)]);
      //   $manager->persist($evaluation);
      // }
      // $manager->flush();
    }
}
