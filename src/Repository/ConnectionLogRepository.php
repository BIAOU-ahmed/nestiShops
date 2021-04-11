<?php

namespace App\Repository;

use App\Entity\ConnectionLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConnectionLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConnectionLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConnectionLog[]    findAll()
 * @method ConnectionLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConnectionLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConnectionLog::class);
    }

    // /**
    //  * @return ConnectionLog[] Returns an array of ConnectionLog objects
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
    public function findOneBySomeField($value): ?ConnectionLog
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
