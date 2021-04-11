<?php

namespace App\Repository;

use App\Entity\Importation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Importation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Importation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Importation[]    findAll()
 * @method Importation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Importation::class);
    }

    // /**
    //  * @return Importation[] Returns an array of Importation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Importation
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
