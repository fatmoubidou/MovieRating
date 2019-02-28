<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use Faker;

class UserFixtures extends Fixture
{
  private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
      //User Admin
      $user = new User();
      $user->setUsername('Fatma');
      $user->setPassword($this->passwordEncoder->encodePassword($user, 'test')); //cryptage du password
      $user->setRoles(['ROLE_ADMIN']);
      $manager->persist($user);

      //Creation 10 Users
      $faker = Faker\Factory::create('fr_FR');
      for ($i=0; $i < 10; $i++) {
        $user = new User();
        $user->setUsername($faker->lastName());
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'.$i));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);
      }
        $manager->flush();
    }
}
