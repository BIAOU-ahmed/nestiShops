<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Comment;
use App\Entity\Grades;
use App\Entity\Recipe;
use App\Form\CommentType;
use App\Form\SearchForm;
use App\Repository\CommentRepository;
use App\Repository\RecipeRepository;
use App\Service\CommentService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class RecipesController extends AbstractController
{
    /**
     * @Route("/recipes", name="recipes")
     */
    public function index(RecipeRepository $recipeRepository, Request $request): Response
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        // dd($data);
        $recipes = $recipeRepository->findSearch($data);

        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('recipes/_recipes.html.twig', ['recipes' => $recipes]),
                'pagination' => $this->renderView('pagination/_pagination.html.twig', ['entities' => $recipes])
            ]);
        }

        return $this->render('recipes/index.html.twig', [
            'controller_name' => 'RecipesController',
            'recipes' => $recipes,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/recipe/{id<[0-9]+>}", name="recipe_show")
     */
    public function show(
        EntityManagerInterface $em,
        FlashBagInterface $flash,
        Recipe $recipe,
        Request $request,
        CommentRepository $commentRepository,
        CommentService $commentService,
        UserInterface $user
    ): Response {
        $comment = new Comment();
        $comments = $commentRepository->findBy(['idRecipe' => $recipe->getIdRecipe()]);
        dump($comments);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && ($_POST['rate'] != "null" || $form->get('commentTitle')->getData() || $form->get('commentContent')->getData())) {
            $comment = $form->getData();
            $rate = new Grades();
            $rate->setIdRecipe($recipe);
            $rate->setIdUsers($user);
            $rate->setRating($_POST['rate']);
            // dump($form);
            // dd($rate);
            $em->persist($rate);
            $em->flush();
            $commentService->persistComment($comment, $recipe, $user);
            return $this->redirectToRoute('recipe_show', ['id' => $recipe->getIdRecipe()]);
        } else if ($form->isSubmitted()) {

            $flash->add('error', 'Veillez entrer un commentaire et/ou une note.');
        }
        return $this->render('recipes/show.html.twig', [
            'form' => $form->createView(),
            'recipe' => $recipe,
            'comments' => $comments
        ]);
    }
}
