<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Personnal;
use Faker\Factory;

class PersonnalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");
        for ($i = 0; $i < 20; $i++) {
            $personnal = new Personnal();
            $personnal
                ->setSurname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setHospitalNode(null)
                ->setAssignment(null)
                ->setRole(null)
                ->setEmail($faker->email)
                ->setPassword($faker->password);
            $manager->persist($personnal);
        }
        
        $personnal = new Personnal();
        $personnal
            ->setSurname("Paul")
            ->setLastname("Didier")
            ->setHospitalNode(null)
            ->setAssignment(null)
            ->setRole(null)
            ->setEmail("test@test.fr")
            ->setPassword('$2y$13$rYPNFY7z0lbXbJWRVp80huRaK8jDmiZsI6fZEd48EiS8eGfyo1BR2');
        
        $manager->persist($personnal);
        $manager->flush();
    }
}
