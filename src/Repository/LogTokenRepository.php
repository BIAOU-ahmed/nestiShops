<?php

namespace App\Repository;

use App\Entity\LogToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LogToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method LogToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method LogToken[]    findAll()
 * @method LogToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogToken::class);
    }

    // /**
    //  * @return LogToken[] Returns an array of LogToken objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LogToken
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
