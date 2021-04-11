<?php

namespace App\Repository;

use App\Entity\ArticlePrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticlePrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticlePrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticlePrice[]    findAll()
 * @method ArticlePrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlePriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticlePrice::class);
    }

    // /**
    //  * @return ArticlePrice[] Returns an array of ArticlePrice objects
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
    public function findOneBySomeField($value): ?ArticlePrice
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
