<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    /**
    * @return Recipe[] Returns an array of Recipe objects
    */
    public function findByTitleField(string $term): array
    {
        $termList = explode(' ', $term);

        return $this->createQueryBuilder('recipe')
            ->leftJoin('recipe.recipeIngredients', 'recipeIngredient')
            ->leftJoin('recipeIngredient.ingredient', 'ingredient')
            ->andWhere('recipe.title LIKE :searchTerm OR recipe.title IN (:termList) OR ingredient.name LIKE :searchTerm')
            ->setParameter('searchTerm', '%'.$term.'%')
            ->setParameter('termList', $termList)
            ->orderBy('recipe.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findById(int $id): Recipe 
    {
        return $this->createQueryBuilder('recipe')
                ->leftJoin('recipe.recipeIngredients', 'ri')
                ->leftJoin('ri.ingredient', 'i')
                ->leftJoin('recipe.recipeTags', 't')
                ->leftJoin('recipe.steps', 's')
                ->addSelect('ri', 'i', 't', 's')
                ->where('recipe.id = :id')
                ->setParameter('id', $id)
                ->orderBy('s.position')
                ->getQuery()
                ->getOneOrNullResult()
            ;
    }

//    public function findOneBySomeField($value): ?Recipe
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
