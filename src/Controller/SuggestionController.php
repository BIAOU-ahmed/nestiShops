<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use App\Repository\ArticleRepository;
use App\Repository\RecipeRepository;
use App\Repository\IngredientRecipeRepository;

class SuggestionController extends AbstractController
{
     
    /**
     * index
     *  @Route("/suggestion", name="suggestion")
     * @param  RecipeRepository $recipeRepository
     * @param  IngredientRecipeRepository $ingredientRecipeRepository
     * @param  IngredientRepository $ingredientRepository
     * @param  ArticleRepository $articleRepository
     * @param  Request $request
     * @return Response
     */
    public function index(RecipeRepository $recipeRepository, IngredientRecipeRepository $ingredientRecipeRepository, IngredientRepository $ingredientRepository, ArticleRepository $articleRepository, Request $request): Response
    {
        $ingredients = $ingredientRepository->findAll();
        $allIngredient = [];
        foreach ($ingredients as $ingredient) {
            $article = $articleRepository->findOneBy(['idProduct' => $ingredient->getIdIngredient()]);
            $imageName = 'noImage.jpg';
            if ($article) {
                $imageName = $article->getImageName();
            }
            $allIngredient[] = ["ingredient" => $ingredient, "article" => $imageName];
        }

        $matchedRecipes = [];
        $possibleRecipes = [];
        
        $recipes = $recipeRepository->findAll();
        if ($request->isXmlHttpRequest()) {
            if (isset($_POST['listOfingredients'])) {
                $ingredientArray = [];
                foreach ($_POST['listOfingredients'] as $ing) {
                    $ingredient = $ingredientRepository->find($ing);
                    $ingredientArray[] = $ingredient;
                    
                }
                
               
                foreach ($recipes as $recipe) {
                    $arrayOfIngredientRecipes = $ingredientRecipeRepository->findBy(['idRecipe' => $recipe]);
                    $ingredientInRecipe = [];
                    foreach ($arrayOfIngredientRecipes as $recipeIngredient) {
                        $ingredientInRecipe[] = $recipeIngredient->getIdProduct();
                    }
                    
                    $diff = array_udiff($ingredientArray, $ingredientInRecipe, function (Ingredient $objA, Ingredient $objB) {
                        return $objA->getIdIngredient() <=> $objB->getIdIngredient();
                    });
                    
                    if (!count($diff)) {
                        $matchedRecipes[] = $recipe;
                    } else {
                        if (count($diff) < count($ingredientArray)) {
                            $possibleRecipes[] = $recipe;
                        }
                    }

                    
                }
            }
            return new JsonResponse([
                'content' => $this->renderView('suggestion/recipes.html.twig', ['mached' => $matchedRecipes, 'possible'=>$possibleRecipes]),
            ]);
        }
        return $this->render('suggestion/index.html.twig', [
            'controller_name' => 'SuggestionController',
            'ingredients' => $allIngredient
        ]);
    }


}
