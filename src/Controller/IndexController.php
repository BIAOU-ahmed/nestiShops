<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findAll();

        $rec = $this->get('session')->get('orderlines');
        dump($rec);
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'recipe' => $recipes,
        ]);
    }
}
