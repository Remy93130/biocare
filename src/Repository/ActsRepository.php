<?php

namespace App\Repository;

use App\Entity\Acts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Acts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acts[]    findAll()
 * @method Acts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Acts::class);
    }
    
    /**
     * Get all acts unfinished by a doctor
     * @param int $idDoctor
     * @return Acts[]
     */
    public function getDoctorUnifinishedActs($idDoctor)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.author = :author')
            ->setParameter('author', $idDoctor)
            ->andWhere('a.state = 0')
            ->orderBy('a.dateCreation', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Acts[] Returns an array of Acts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Acts
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
