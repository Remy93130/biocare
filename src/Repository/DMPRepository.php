<?php

namespace App\Repository;

use App\Entity\DMP;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DMP|null find($id, $lockMode = null, $lockVersion = null)
 * @method DMP|null findOneBy(array $criteria, array $orderBy = null)
 * @method DMP[]    findAll()
 * @method DMP[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DMPRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DMP::class);
    }

    // /**
    //  * @return DMP[] Returns an array of DMP objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DMP
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
