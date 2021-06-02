<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\GradesRepository;
use App\Repository\RecipeRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(RecipeRepository $recipeRepository, GradesRepository $gradesRepository, CommentRepository $commentRepository, UsersRepository $usersRepository): Response
    {
        // $comment = $commentRepository->findAll();

        $allUser = $usersRepository->findAll();
        $allRecipes = $recipeRepository->findAll();
        $comments = $commentRepository->findAll();
        $appreciations = [];
        foreach ($allUser as $oneUser) {
            foreach ($allRecipes as $recipe) {
                $userComment = $commentRepository->findOneBy(['idRecipe' => $recipe->getIdRecipe(), 'idUsers' => $oneUser->getIdUsers(), 'flag' => ['a']]);
                $userGrade = $gradesRepository->findOneBy(['idRecipe' => $recipe->getIdRecipe(), 'idUsers' => $oneUser->getIdUsers()]);
                if ($userComment || $userGrade) {
                    $date = $userComment ? $userComment->getDateCreation() : $userGrade->getDateCreation();
                    $appreciations[] = ['user' => $oneUser, 'comment' => $userComment, 'grade' => $userGrade, "date" => $date];
                }
            }
        }
        // $rec = $this->get('session')->get('orderlines');
        if(session_id() == ''){
            session_start();
         }

        //unset($_SESSION['visites']);

        if (!isset($_SESSION['visites'])) {
            $_SESSION['visites'] = [];
        }

        arsort($_SESSION['visites']);

        $lastPage = array_slice($_SESSION['visites'], 0, 5, true);
        $lastRecipes = [];
        foreach ($lastPage as $key => $value) {
            $recipe = $recipeRepository->findOneBy(['idRecipe'=> $key]);
            $lastRecipes[] = $recipe;
        }
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'appreciations' => $appreciations,
            'lastRecipes' => $lastRecipes
        ]);
    }
}
