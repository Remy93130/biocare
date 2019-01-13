<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\HospitalNode;

class HospitalNodeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $node = new HospitalNode();
        $node->setResponsible(null);
        
        $manager->flush();
    }
}
