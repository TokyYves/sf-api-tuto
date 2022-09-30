<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface) 
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }
    public function load(ObjectManager $manager ): void
    {
        $faker = Factory::create();
        
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            
            $hashPass = $this->userPasswordHasherInterface->hashPassword($user,'password');
            
            $user->setEmail($faker->email())
                ->setName($faker->name())
                ->setStatus($faker->boolean())
                ->setPassword($hashPass);

            $manager->persist($user);

            for ($i=0; $i < random_int(5,10) ; $i++) { 
                $post = new Post();

                $post->setAuthor($user)
                    ->setTitle($faker->country())
                    ->setDescription($faker->paragraph());
                $manager->persist($post);
            }

        }
        $manager->flush();
    }
}
