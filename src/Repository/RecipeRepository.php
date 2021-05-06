<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Recipe::class);
        $this->paginator = $paginator;
    }

    // /**
    //  * @return Recipe[] Returns an array of Recipe objects
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
    public function findOneBySomeField($value): ?Recipe
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllForApi(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM view_api_recipes
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }

    public function findAllGlutenForApi(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM view_api_recipes
            WHERE cat="gluten"

            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }

    /**
     * 
     *@return PaginationInterface 
     */
    public function findSearch(SearchData $search){
        // return $this->findAll();
        $query = $this
        ->createQueryBuilder('r')
        ->select('c','r')
        ->join('r.category','c');

        if(!empty($search->q)){
            $query = $query
            ->andWhere('r.name LIKE :q')
            ->setParameter('q', "%{$search->q}%");
        }
        if(!empty($search->categories)){
            $query = $query
            ->andWhere('c.id IN (:categories)')
            ->setParameter('categories', $search->categories);
        }
        dump($search->q);
        dump($query->getQuery());
        $query =  $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            6
        );
    }
}
