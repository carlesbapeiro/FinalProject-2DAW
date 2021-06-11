<?php

namespace App\Repository;

use App\Entity\Representant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Representant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Representant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Representant[]    findAll()
 * @method Representant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepresentantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Representant::class);
    }

    /**
     * @return Representant[] Returns an array of Movie objects
     */

    public function filterByText(string $text): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orWhere('r.nom LIKE :value')
            ->orWhere('r.cognom LIKE :value');

        $qb->setParameter('value', "%".$text."%");
        $qb->orderBy('r.nom', 'ASC');
        $query = $qb->getQuery();
        return $query->getResult();
    }

    // /**
    //  * @return Representant[] Returns an array of Representant objects
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
    public function findOneBySomeField($value): ?Representant
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
