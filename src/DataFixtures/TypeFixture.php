<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Type;

class TypeFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $types = [
            "CARDIOLOGIE",
            "OPHTALMOLOGIE",
            "RADIOTHERAPIQUE",
            "PNEUMOLOGIE",
        ];
        
        foreach ($types as $type_name) {
            $type = new Type();
            $type->setName($type_name);
            $manager->persist($type);
        }
        $manager->flush();
    }
}

