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
     * @Route("/suggestion", name="suggestion")
     */
    public function index(RecipeRepository $recipeRepository, IngredientRecipeRepository $ingredientRecipeRepository, IngredientRepository $ingredientRepository, ArticleRepository $articleRepository, Request $request): Response
    {
        $ingredients = $ingredientRepository->findAll();
        $allIngredient = [];
        foreach ($ingredients as $ingredient) {
            $article = $articleRepository->findOneBy(['idProduct' => $ingredient->getIdIngredient()]);
            $imageName = 'defaul';
            if ($article) {
                $imageName = $article->getImageName();
            }
            $allIngredient[] = ["ingredient" => $ingredient, "article" => $imageName];
        }

        $recipes = $recipeRepository->findAll();
        if ($request->isXmlHttpRequest()) {
            if (isset($_POST['listOfingredients'])) {
//                dump($_POST['listOfingredients']);
                $ingredientArray = [];
                foreach ($_POST['listOfingredients'] as $ing) {
                    $ingredient = $ingredientRepository->find($ing);
                    $ingredientArray[] = $ingredient;
//                    dump($ingredient);
//                    dump($ing);
                }
//                dump($ingredientArray);
                $matchedRecipes = [];
                $possibleRecipes = [];
                foreach ($recipes as $recipe) {
                    $arrayOfIngredientRecipes = $ingredientRecipeRepository->findBy(['idRecipe' => $recipe]);
                    $ingredientInRecipe = [];
                    foreach ($arrayOfIngredientRecipes as $recipeIngredient) {
                        $ingredientInRecipe[] = $recipeIngredient->getIdProduct();
                    }
//                    dump($ingredientInRecipe);
//                    dump($ingredientArray);


                    $diff = array_udiff($ingredientArray, $ingredientInRecipe, function (Ingredient $objA, Ingredient $objB) {
                        return $objA->getIdIngredient() <=> $objB->getIdIngredient();
                    });
//                    dump($diff);
                    if (!count($diff)) {
                        $matchedRecipes[] = $recipe;
                    } else {
                        if (count($diff) < count($ingredientArray)) {
                            $possibleRecipes[] = $recipe;
                        }
                    }

//                    $result = array_diff($ingredientArray, $ingredientInRecipe);
//                    dump($result);
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
