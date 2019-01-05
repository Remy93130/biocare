<?php

namespace App\Repository;

use App\Entity\HospitalNode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HospitalNode|null find($id, $lockMode = null, $lockVersion = null)
 * @method HospitalNode|null findOneBy(array $criteria, array $orderBy = null)
 * @method HospitalNode[]    findAll()
 * @method HospitalNode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HospitalNodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HospitalNode::class);
    }

    // /**
    //  * @return HospitalNode[] Returns an array of HospitalNode objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HospitalNode
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
