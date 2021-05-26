<?php

namespace App\Repository;

use App\Entity\Cicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cicle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cicle[]    findAll()
 * @method Cicle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cicle::class);
    }

    // /**
    //  * @return Cicle[] Returns an array of Cicle objects
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

    /*
    public function findOneBySomeField($value): ?Cicle
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
