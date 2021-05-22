<?php

namespace App\Repository;

use App\Data\SearchArticleData;
use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Article::class);
        $this->paginator = $paginator;
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
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
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param SearchArticleData $search
     * @return PaginationInterface
     */
    public function findSearch(SearchArticleData $search){

        $query = $this
            ->createQueryBuilder('a');

        if(!empty($search->q)){
            $query = $query
                ->join('a.idUnit', 'u')
                ->join('a.idProduct', 'p')
                ->andWhere('a.name LiKe :q or CONCAT(a.unitQuantity,\' \',u.name,\' de \',p.name) LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }
        $query =  $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            6
        );

    }
}
