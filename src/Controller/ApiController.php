<?php

namespace App\Controller;

use App\Entity\Paragraph;
use App\Entity\Recipe;
use App\Repository\IngredientRecipeRepository;
use App\Repository\ParagraphRepository;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;


class ApiController extends AbstractController
{
    /**
     * @Route("/api/recipes", name="api")
     */
    public function index(RecipeRepository $recipe): Response
    {
        $recipes = $recipe->findAllForApi();

        return $this->json($recipes);

        // return $this->render('api/index.html.twig', [
        //     'controller_name' => 'ApiController',
        //     'rec' => $recipes
        // ]);
    }
    /**
     * @Route("/api/category/gluten", name="api_gluten")
     */
    public function gluten(RecipeRepository $recipe): Response
    {
        $recipes = $recipe->findAllGlutenForApi();

        return $this->json($recipes);

        // return $this->render('api/index.html.twig', [
        //     'controller_name' => 'ApiController',
        //     'rec' => $recipes
        // ]);
    }

    /**
     * @Route("/api/recipe/{id<[0-9]+>}/paragraph", name="api_recipe")
     */
    public function showParagraph(Recipe $recipe, SerializerInterface $serializer, ParagraphRepository $recipePara)
    {
        $recipeRepo = $recipePara->findBy(['idRecipe' => $recipe->getIdRecipe()]);
        // dd($recipe->getParagraphs()[0]);
        // $resp = $recipe->getParagraphs();
        // $json = $serializer->serialize(
        //     $recipeRepo,
        //     'json',
        //     ['groups' => 'show_recipe']
        // );
        // dd($recipeRepo);

        $encoder = new JsonEncoder();
        // $defaultContext = [
        //     AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
        //         return $object->getName();
        //     },
        // ];
        // $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        // $serializer = new Serializer([$normalizer], [$encoder]);
        $s = $serializer->serialize($recipeRepo, 'json', ['attributes' => ['idParagraph','content', 'paragraphPosition', 'dateCreation', '']]);
        $productDeserialized = $serializer->deserialize($s, Paragraph::class, 'json', ['attributes' => ['idParagraph','content', 'paragraphPosition', 'dateCreation', '']]);
        // dd(json_decode($s));
        // dd($productDeserialized);
        // return $serializer->serialize($recipeRepo, 'json');
        return $this->json(json_decode($s));

        // return $this->render('api/index.html.twig', [
        //     'controller_name' => 'ApiController',
        //     'rec' => $recipes
        // ]);
    }

    /**
     * @Route("/api/recipe/{id<[0-9]+>}/ingredient", name="api_recipe_ingredient")
     */
    public function showIngredientRecipe(Recipe $recipe, SerializerInterface $serializer, IngredientRecipeRepository $recipeIng): Response
    {
        $recipeIngredients = $recipeIng->findAllIngredientForRecipe($recipe->getIdRecipe());
        // dd($recipe->getParagraphs()[0]);
        // $resp = $recipe->getIngredientRecipes();
        // $json = $serializer->serialize(
        //     $recipeRepo,
        //     'json',
        //     ['groups' => 'show_recipe']
        // );
        // dd($recipeRepo);
        // $s = $serializer->serialize($recipeIngredients, 'json', ['attributes' => ['idProduct','quantity', 'recipePosition', 'idUnit']]);
       
        return $this->json($recipeIngredients);

        // return $this->render('api/index.html.twig', [
        //     'controller_name' => 'ApiController',
        //     'rec' => $recipes
        // ]);
    }
}
