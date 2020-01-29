<?php

namespace App\Repository;

use App\Entity\CategoryMesurement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryMesurement|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryMesurement|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryMesurement[]    findAll()
 * @method CategoryMesurement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryMesurementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryMesurement::class);
    }

    // /**
    //  * @return CategoryMesurement[] Returns an array of CategoryMesurement objects
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
    public function findOneBySomeField($value): ?CategoryMesurement
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
