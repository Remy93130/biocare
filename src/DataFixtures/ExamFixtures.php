<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Exam;
use Faker\Factory;

class ExamFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $exam = new Exam();
            $exam
                ->setDmp(null)
                ->setContent($faker->sentence)
                ->setTitle("Exam test no " . $i)
                ->setState($i % 2)
            ;
            $manager->persist($exam);
        }

        $manager->flush();
    }
}
