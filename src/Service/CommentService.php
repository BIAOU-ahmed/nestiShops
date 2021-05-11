<?php

namespace App\Service;

use App\Entity\Comment;
use App\Entity\Recipe;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;

class CommentService
{
    private $manager;

    public function __construct(EntityManagerInterface $manager )
    {
        $this->manager = $manager;
    }

    public function persistComment(Comment $comment, Recipe $recipe, Users $user)
    {
        $mainComment = $comment->getIdUsers();
        dump('main comment befor', $mainComment);
        $comment->setFlag('w')
            ->setIdRecipe($recipe)
            ->setIdUsers($user)
            ->setDateCreation( new \DateTime('now', new \DateTimeZone('Europe/Paris')));
        dump('main comment after', $mainComment);
        if (!$mainComment) {
            dump('comment dont have Id');
            $this->manager->persist($comment);

        }
        $this->manager->flush();
    }
}