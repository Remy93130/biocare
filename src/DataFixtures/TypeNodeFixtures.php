<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\TypeNode;

class TypeNodeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $types = [
            "HOPITAL",
            "POLE",
            "SERVICE",
            "UNITE_FONCTIONNELLE",
            "UNITE_HOSPITALIERE"
        ];
        
        $i = 0;
        foreach ($types as $type_name) {
            $type = new TypeNode();
            $type->setName($type_name)
                ->setWeight($i);
            $i++;
            $manager->persist($type);
        }
        $manager->flush();
    }
}
