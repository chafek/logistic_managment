<?php

namespace App\Repository;

use App\Entity\ItemState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ItemState|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemState|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemState[]    findAll()
 * @method ItemState[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemStateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemState::class);
    }

    // /**
    //  * @return ItemState[] Returns an array of ItemState objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ItemState
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
