<?php

namespace App\Service;

use App\Entity\Comment;
use App\Entity\Recipe;
use App\Entity\Users;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class CommentService
{
    private $manager;
    private $flash;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flash )
    {
        $this->manager = $manager;
        $this->flash = $flash;
    }

    public function persistComment(Comment $comment, Recipe $recipe, Users $user){
        $comment->setFlag('w')
                ->setIdRecipe($recipe)
                ->setIdUsers($user)
                ->setDateCreation(new DateTime('now'));
        $this->manager->persist($comment);
        $this->manager->flush();
        $this->flash->add('success', 'Votre commentaire est bien envoyé, merci.');
    }
}