<?php

namespace App\Repository;

use App\Entity\Member;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\Cast\String_;

/**
 * @method Member|null find($id, $lockMode = null, $lockVersion = null)
 * @method Member|null findOneBy(array $criteria, array $orderBy = null)
 * @method Member[]    findAll()
 * @method Member[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Member|null findOneByFirstnameAndLastname(String $firstname,String $lastname)
 */
class MemberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Member::class);
    }

    // /**
    //  * @return Member[] Returns an array of Member objects
    //  */
    
    public function findOneByFirstnameAndLastname($firstname,$lastname)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.firstname = :firstname and m.lastname=:lastname')
            ->setParameters(['firstname'=>$firstname,'lastname'=>$lastname])
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Member
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
//     */
//    public function findOneByFirstnameAndLastname(String $firstname,String $lastname ){
//        $qb=$this->createQueryBuilder('m');
//         return  $qb->select('m')
//                     ->where("m.firstName=:firstname")
//                     ->andWhere("m.lastName=:lastname")
//                     ->setParameter('firstname',$firstname)
//                     ->setParameter('lastname',$lastname)
//                     ->getQuery()
//                     ->getOneOrNullResult();

//    }
}
