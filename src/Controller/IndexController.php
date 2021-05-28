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
                $userComment = $commentRepository->findOneBy(['idRecipe' => $recipe->getIdRecipe(),'idUsers' => $oneUser->getIdUsers(), 'flag' => ['a']]);
                $userGrade = $gradesRepository->findOneBy(['idRecipe' => $recipe->getIdRecipe(),'idUsers' => $oneUser->getIdUsers()]);
                if ($userComment || $userGrade) {
                    $date = $userComment ? $userComment->getDateCreation() : $userGrade->getDateCreation();
                    $appreciations[] = ['user' => $oneUser, 'comment' => $userComment, 'grade' => $userGrade, "date" => $date];
                }
            }
        }
        $rec = $this->get('session')->get('orderlines');
        dump($rec);
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'appreciations' => $appreciations
        ]);
    }
}
