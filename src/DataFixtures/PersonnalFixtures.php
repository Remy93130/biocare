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
                ->setSurname($faker->lastName)
                ->setLastname($faker->lastName)
                ->setHospitalNode(null)
                ->setAssignment(null)
                ->setRole(null)
                ->setEmail($faker->email)
                ->setPassword($faker->password);
            $manager->persist($personnal);
        }

        $manager->flush();
    }
}
