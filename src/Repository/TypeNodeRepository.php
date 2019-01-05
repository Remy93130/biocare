<?php

namespace App\Repository;

use App\Entity\TypeNode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeNode|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeNode|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeNode[]    findAll()
 * @method TypeNode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeNodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeNode::class);
    }

    // /**
    //  * @return TypeNode[] Returns an array of TypeNode objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeNode
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
