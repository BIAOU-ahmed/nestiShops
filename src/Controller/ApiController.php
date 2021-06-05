<?php

namespace App\Controller;

use App\Entity\LogToken;
use App\Entity\Paragraph;
use App\Entity\Recipe;
use App\Repository\IngredientRecipeRepository;
use App\Repository\ParagraphRepository;
use App\Repository\RecipeRepository;
use App\Repository\TokenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
     
    /**
     * index
     * @Route("/api/recipes", name="api")
     * @param  RecipeRepository $recipe
     * @return Response
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
     * findByCategory
     * @Route("/api/category/{slug}", name="api_gluten")
     * @param  UserInterface $user
     * @param  EntityManagerInterface $em
     * @param  String $slug
     * @param  RecipeRepository $recipe
     * @param  TokenRepository $tokenRepository
     * @param  Request $request
     * @return Response
     */
    public function findByCategory(UserInterface $user = null, EntityManagerInterface $em, String $slug, RecipeRepository $recipe, TokenRepository $tokenRepository, Request $request): Response
    {

        $token = $request->get('token', 1);
        $check = $tokenRepository->findOneBy(['name' => $token]);
        if ($check) {
            $apiLog = new LogToken();
            $agent = $request->headers->get("user-agent");
            $apiLog->setUserAgent($agent);

            $apiLog->setToken($check);

            if ($user) {
                $apiLog->setUser($user);
            }
            $em->persist($apiLog);
            $em->flush();
            $recipes = $recipe->findAllByCategoryForApi($slug);

            return $this->json($recipes);
        } else {
            return $this->json("Accès refusé");
        }


        // return $this->render('api/index.html.twig', [
        //     'controller_name' => 'ApiController',
        //     'rec' => $recipes
        // ]);
    }

     
    /**
     * showParagraph
     * @Route("/api/recipe/{id<[0-9]+>}/paragraph", name="api_recipe")
     * @param  UserInterface $user
     * @param  EntityManagerInterface $em
     * @param  TokenRepository $tokenRepository
     * @param  Recipe $recipe
     * @param  SerializerInterface $serializer
     * @param  ParagraphRepository $recipePara
     * @param  Request $request
     * @return JsonResponse
     */
    public function showParagraph(UserInterface $user = null, EntityManagerInterface $em,TokenRepository $tokenRepository, Recipe $recipe, SerializerInterface $serializer, ParagraphRepository $recipePara,  Request $request)
    {
        $token = $request->get('token', 1);
        // $check = "zjkskbjvsdqkpjsdqvo_zpoergivmlqsmlkvdsqkjbdsqkluazempoazelmjvsqm,uqzieez6962587z3vz523473vzqjgbyjq";
        $check = $tokenRepository->findOneBy(['name' => $token]);
        if ($check) {

            $apiLog = new LogToken();
            $agent = $request->headers->get("user-agent");
            $apiLog->setUserAgent($agent);

            $apiLog->setToken($check);

            if ($user) {
                $apiLog->setUser($user);
            }
            $em->persist($apiLog);
            $em->flush();

            $recipeRepo = $recipePara->findBy(['idRecipe' => $recipe->getIdRecipe()]);


            $encoder = new JsonEncoder();
            $s = $serializer->serialize($recipeRepo, 'json', ['attributes' => ['idParagraph', 'content', 'paragraphPosition', 'dateCreation', '']]);
            $productDeserialized = $serializer->deserialize($s, Paragraph::class, 'json', ['attributes' => ['idParagraph', 'content', 'paragraphPosition', 'dateCreation', '']]);

            return $this->json(json_decode($s));
        } else {
            return $this->json("Accès refusé");
        }
    }

      
    /**
     * showIngredientRecipe
     * @Route("/api/recipe/{id<[0-9]+>}/ingredient", name="api_recipe_ingredient")
     * @param  UserInterface $user
     * @param  EntityManagerInterface $em
     * @param  TokenRepository $tokenRepository
     * @param  Recipe $recipe
     * @param  IngredientRecipeRepository $recipeIng
     * @param  Request $request
     * @return Response
     */
    public function showIngredientRecipe(UserInterface $user = null, EntityManagerInterface $em,TokenRepository $tokenRepository, Recipe $recipe, IngredientRecipeRepository $recipeIng, Request $request): Response
    {

        $token = $request->get('token', 1);
        $check = $tokenRepository->findOneBy(['name' => $token]);
        if ($check) {

            $apiLog = new LogToken();
            $agent = $request->headers->get("user-agent");
            $apiLog->setUserAgent($agent);

            $apiLog->setToken($check);

            if ($user) {
                $apiLog->setUser($user);
            }
            $em->persist($apiLog);
            $em->flush();

            $recipeIngredients = $recipeIng->findAllIngredientForRecipe($recipe->getIdRecipe());

            return $this->json($recipeIngredients);
        } else {
            return $this->json("Accès refusé");
        }
    }

       
    /**
     * searchRecipe
     * @Route("/api/search/{slug}", name="api_search")
     * @param  UserInterface $user
     * @param  EntityManagerInterface $em
     * @param  TokenRepository $tokenRepository
     * @param  string $slug
     * @param  RecipeRepository $recipeRepository
     * @param  Request $request
     * @return JsonResponse
     */
    public function searchRecipe(UserInterface $user = null, EntityManagerInterface $em,TokenRepository $tokenRepository, string $slug, RecipeRepository $recipeRepository, Request $request)
    {
        $token = $request->get('token', 1);
        // $check = "zjkskbjvsdqkpjsdqvo_zpoergivmlqsmlkvdsqkjbdsqkluazempoazelmjvsqm,uqzieez6962587z3vz523473vzqjgbyjq";
        $check = $tokenRepository->findOneBy(['name' => $token]);
        if ($check) {

            $apiLog = new LogToken();
            $agent = $request->headers->get("user-agent");
            $apiLog->setUserAgent($agent);

            $apiLog->setToken($check);

            if ($user) {
                $apiLog->setUser($user);
            }
            $em->persist($apiLog);
            $em->flush();
            $data = $recipeRepository->findByLike($slug);
        } else {
            return $this->json("Accès refusé");
        }
        return $this->json($data);
    }
}
