<?php

namespace App\Repository;

use App\Entity\HourWorktime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HourWorktime|null find($id, $lockMode = null, $lockVersion = null)
 * @method HourWorktime|null findOneBy(array $criteria, array $orderBy = null)
 * @method HourWorktime[]    findAll()
 * @method HourWorktime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HourWorktimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HourWorktime::class);
    }

    // /**
    //  * @return HourWorktime[] Returns an array of HourWorktime objects
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
    public function findOneBySomeField($value): ?HourWorktime
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
