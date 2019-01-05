<?php

namespace App\Repository;

use App\Entity\Personnal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Personnal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personnal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personnal[]    findAll()
 * @method Personnal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnalRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Personnal::class);
    }

    // /**
    //  * @return Personnal[] Returns an array of Personnal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Personnal
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
