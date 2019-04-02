<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\DMP;
use App\Repository\DMPRepository;
use Doctrine\Common\Persistence\ObjectManager;

class PersonnalTest extends TestCase
{
    public function testCRUD()
    {
        $dmp = New DMP();
        $dmp
            ->setAddress("undefined")
            ->setBirthDate(new \DateTime())
            ->setBirthPlace("New York")
            ->setName("John")
            ->setNodeManaging(null)
            ->setSocialNumber("110011101")
            ->setSurname("Doe")
        ;
        $dmpRepository = $this->createMock(DMPRepository::class);

        $dmpRepository->expects($this->any())
            ->method('find')
            ->willReturn($dmp);

        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($dmpRepository);

        $this->assertEquals($dmp->getDisplayName(), "Doe John - 110011101");
    }

    public function testInsertion()
    {
        $dmp = New DMP();
        $dmp
            ->setAddress("undefined")
            ->setBirthDate(new \DateTime())
            ->setBirthPlace("New York")
            ->setName("John")
            ->setNodeManaging(null)
            ->setSocialNumber("110011101")
            ->setSurname("Doe")
        ;
        $dmpRepository = $this->createMock(DMPRepository::class);

        $dmpRepository->expects($this->any())
            ->method('find')
            ->willReturn($dmp);

        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($dmpRepository);

        $this->assertEquals($dmp->getDisplayName(), "Doe John - 110011101");
    }

    public function testChangeHospital()
    {
        $dmp = New DMP();
        $dmp
            ->setAddress("undefined")
            ->setBirthDate(new \DateTime())
            ->setBirthPlace("New York")
            ->setName("John")
            ->setNodeManaging(null)
            ->setSocialNumber("110011101")
            ->setSurname("Doe")
        ;
        $dmpRepository = $this->createMock(DMPRepository::class);

        $dmpRepository->expects($this->any())
            ->method('find')
            ->willReturn($dmp);

        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($dmpRepository);

        $this->assertEquals($dmp->getDisplayName(), "Doe John - 110011101");
    }

    public function testDeleteBoss()
    {
        $dmp = New DMP();
        $dmp
            ->setAddress("undefined")
            ->setBirthDate(new \DateTime())
            ->setBirthPlace("New York")
            ->setName("John")
            ->setNodeManaging(null)
            ->setSocialNumber("110011101")
            ->setSurname("Doe")
        ;
        $dmpRepository = $this->createMock(DMPRepository::class);

        $dmpRepository->expects($this->any())
            ->method('find')
            ->willReturn($dmp);

        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($dmpRepository);

        $this->assertEquals($dmp->getDisplayName(), "Doe John - 110011101");
    }

    public function testError()
    {
        $dmp = New DMP();
        $dmp
            ->setAddress("undefined")
            ->setBirthDate(new \DateTime())
            ->setBirthPlace("New York")
            ->setName("John")
            ->setNodeManaging(null)
            ->setSocialNumber("110011101")
            ->setSurname("Doe")
        ;
        $dmpRepository = $this->createMock(DMPRepository::class);

        $dmpRepository->expects($this->any())
            ->method('find')
            ->willReturn($dmp);

        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($dmpRepository);

        $this->assertEquals($dmp->getDisplayName(), "Doe John - 110011101");
    }
}
