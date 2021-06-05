<?php

namespace App\Repository;

use App\Entity\IngredientRecipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IngredientRecipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method IngredientRecipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method IngredientRecipe[]    findAll()
 * @method IngredientRecipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientRecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IngredientRecipe::class);
    }

    
    /**
     * findAllIngredientForRecipe
     *
     * @param  mixed $id
     * @return array<int,array<string, mixed>>
     */
    public function findAllIngredientForRecipe($id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT p.idProduct as id, p.name as product, i.quantity as quantity, i.recipePosition as recipePosition, u.name as unit FROM ingredientrecipe i INNER JOIN product p ON i.idProduct = p.idProduct INNER JOIN unit u ON i.idUnit = u.idUnit
        WHERE  	idRecipe= ?

            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }

    // /**
    //  * @return IngredientRecipe[] Returns an array of IngredientRecipe objects
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
    public function findOneBySomeField($value): ?IngredientRecipe
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
