<?php

namespace App\Repository;

use App\Entity\Rf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rf[]    findAll()
 * @method Rf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rf::class);
    }

    // /**
    //  * @return Rf[] Returns an array of Rf objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rf
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
