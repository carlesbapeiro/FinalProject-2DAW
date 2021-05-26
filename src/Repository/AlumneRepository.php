<?php

namespace App\Repository;

use App\Entity\Alumne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Alumne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alumne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alumne[]    findAll()
 * @method Alumne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlumneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alumne::class);
    }

    // /**
    //  * @return Alumne[] Returns an array of Alumne objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Alumne
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
