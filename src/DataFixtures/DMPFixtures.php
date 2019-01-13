<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\DMP;

class DMPFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $dmp = new DMP();
            $dmp
                ->setAddress($faker->address)
                ->setBirthDate($faker->dateTimeThisDecade)
                ->setBirthPlace($faker->city)
                ->setName($faker->firstName)
                ->setSurname($faker->lastName)
                ->setSocialNumber($faker->numberBetween(100000000000000, 199999999999999));
            $manager->persist($dmp);
        }
        $manager->flush();
    }
}
