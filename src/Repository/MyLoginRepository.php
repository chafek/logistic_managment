<?php

namespace App\Repository;

use App\Entity\MyLogin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MyLogin|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyLogin|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyLogin[]    findAll()
 * @method MyLogin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyLoginRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyLogin::class);
    }

    // /**
    //  * @return MyLogin[] Returns an array of MyLogin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MyLogin
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
