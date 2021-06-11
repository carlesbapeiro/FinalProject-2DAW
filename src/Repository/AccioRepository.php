<?php

namespace App\Repository;

use App\Entity\Accio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Accio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accio[]    findAll()
 * @method Accio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accio::class);
    }

    public function filterByText(string $text): array
    {
        $qb = $this->createQueryBuilder('ac')
            ->orWhere('ac.titol LIKE :value');

        $qb->setParameter('value', "%".$text."%");
        $qb->orderBy('ac.titol', 'ASC');
        $query = $qb->getQuery();
        return $query->getResult();
    }

    // /**
    //  * @return Accio[] Returns an array of Accio objects
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
    public function findOneBySomeField($value): ?Accio
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
