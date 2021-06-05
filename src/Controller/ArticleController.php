<?php

namespace App\Controller;

use App\Data\SearchArticleData;
use App\Entity\Article;
use App\Form\SearchArticleForm;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
     
    /**
     * index
     *  @Route("/articles", name="articles")
     * @param  ArticleRepository $articleRepo
     * @param  Request $request
     * @return Response
     */
    public function index(ArticleRepository $articleRepo, Request $request): Response
    {

        $data = new SearchArticleData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchArticleForm::class, $data);
        $form->handleRequest($request);

        $articles = $articleRepo->findSearch($data);

        if($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('article/_article.html.twig', ['articles' => $articles]),
                'pagination' => $this->renderView('pagination/_pagination.html.twig', ['entities' => $articles])
            ]);
        }
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
            'form' => $form->createView()
        ]);
    }

      
    /**
     * show
     *  @Route("/article/{id<[0-9]+>}", name="article_show")
     * @param  Article $article
     * @return Response
     */
    public function show(Article $article): Response {
        $array = [];
        if($article->getIdProduct()->getIngredient()){

            $array = $article->getIdProduct()->getIngredient()->getIngredientRecipes();
        }
        $recipes = [];
      foreach ($array as $ingredientRecipe){
          
          $recipes[] = $ingredientRecipe->getIdRecipe();
      }
      
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'recipes' =>$recipes
        ]);
    }
}
