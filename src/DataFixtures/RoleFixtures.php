<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Role;


class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $roles = [
            "MEDECIN",
            "SECRETAIRE",
            "LABORATOIRE",
            "DATA_AMIN",
            "INFERMIERE"
        ];
        foreach ($roles as $role_name) {
            $role = new Role();
            $role->setName($role_name);
            $manager->persist($role);
        }
        $manager->flush();
    }
}
