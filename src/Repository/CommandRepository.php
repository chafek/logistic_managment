<?php

namespace App\Repository;

use App\Entity\Command;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\DateType;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\Cast\Array_;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @method Command|null find($id, $lockMode = null, $lockVersion = null)
 * @method Command|null findOneBy(array $criteria, array $orderBy = null)
 * @method Command[]    findAll()
 * @method Command[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Command::class);
    }

    // /**
    //  * @return Command[] Returns an array of Command objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    
    public function findQtyByTypo(String $typo): ?array
    {
        return $this->createQueryBuilder('c')
            ->select("SUM(c.quantita) as total")
            ->andWhere("c.tipo_movimento=:typo")
            ->setParameter('typo', $typo)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findQtyByTypoBetweenDate(String $typo,String $dateStart,String $dateEnd): ?array
    {
        return $this->createQueryBuilder('c')
            ->select("SUM(c.quantita) as totalDate")
            ->Where("c.tipo_movimento=:typo")
            ->andWhere("c.data_movimento >=:dateStart")
            ->andWhere("c.data_movimento <=:dateEnd")
            ->setParameter('typo', $typo)
            ->setParameter('dateStart',$dateStart)
            ->setParameter('dateEnd',$dateEnd)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findQtyByTypoBetweenDateByProfilo(String $typo,String $dateStart,String $dateEnd): ?array
    {
        return $this->createQueryBuilder('c')
            ->select("c.profilo,SUM(c.quantita)as totalDate")
            ->groupBy('c.profilo')
            ->distinct(true)
            ->Where("c.tipo_movimento=:typo")
            ->andWhere("c.data_movimento >=:dateStart")
            ->andWhere("c.data_movimento <=:dateEnd")
            ->setParameter('typo', $typo)
            ->setParameter('dateStart',$dateStart)
            ->setParameter('dateEnd',$dateEnd)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findProfilsByTypoAndDate($typo,$dateStart,$dateEnd){
        return $this->createQueryBuilder('c')
            ->select("c.profilo")
            ->distinct(true)
            ->Where("c.tipo_movimento=:typo")
            ->andWhere("c.data_movimento >=:dateStart")
            ->andWhere("c.data_movimento <=:dateEnd")
            ->setParameter('typo', $typo)
            ->setParameter('dateStart',$dateStart)
            ->setParameter('dateEnd',$dateEnd)
            ->getQuery()
            ->getResult();

    }

    public function findHourByDate($dateStart,$dateEnd,$typo): ?array
    {
        return $this->createQueryBuilder('c')
            
        // "c.profilo as profil,c.data_movimento,MIN(c.ora_movimento) as min_ora_movimento,MAX(c.ora_movimento) as max_ora_movimento
            ->select("c.profilo as profil,c.data_movimento,MIN(c.ora_movimento) as min_ora_movimento,MAX(c.ora_movimento) as max_ora_movimento")
            ->groupBy("c.profilo")
            ->addGroupBy("c.data_movimento")
            ->Where("c.tipo_movimento=:typo")
            ->andWhere("c.data_movimento >=:dateStart")
            ->andWhere("c.data_movimento <=:dateEnd")
            ->setParameter('typo', $typo)
            ->setParameter('dateStart',$dateStart)
            ->setParameter('dateEnd',$dateEnd)
            ->orderBy('c.data_movimento','asc')
            ->orderBy('c.profilo','asc')
            ->getQuery()
            ->getResult();
    }
    // public function findMaxHourByDate($dateStart,$dateEnd,$typo)
    // {
    //     return $this->createQueryBuilder('c')
    //         ->select("c.profilo,MIN(c.ora_movimento) as ora_movimento")
    //         ->groupBy("c.profilo")
    //         ->addGroupBy("c.data_movimento")
    //         ->Where("c.tipo_movimento=:typo")
    //         ->andWhere("c.data_movimento >=:dateStart")
    //         ->andWhere("c.data_movimento <=:dateEnd")
    //         ->setParameter('typo', $typo)
    //         ->setParameter('dateStart',$dateStart)
    //         ->setParameter('dateEnd',$dateEnd)
    //         ->orderBy('c.data_movimento','asc')
    //         ->orderBy('c.profilo','asc')
    //         ->getQuery()
    //         ->getResult();
    // }

    public function findDistinctDate()
    {
        return $this->createQueryBuilder('c')
            ->select("c.data_movimento as data_movimento")
            ->distinct(true)
            ->orderBy('data_movimento', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findMinDate()
    {
        return $this->createQueryBuilder('c')
            ->select("MIN(c.data_movimento) as data_min")
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findMaxDate()
    {
        return $this->createQueryBuilder('c')
            ->select("MAX(c.data_movimento) as data_max")
            ->getQuery()
            ->getOneOrNullResult();
    }
}
