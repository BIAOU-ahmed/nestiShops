<?php

namespace App\Service;

use App\Entity\Comment;
use App\Entity\Recipe;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;

class CommentService
{    
    /**
     * manager
     *
     * @var mixed
     */
    private $manager;
    
    /**
     * __construct
     *
     * @param  EntityManagerInterface $manager
     * @return void
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    
    /**
     * persistComment
     *
     * @param  Comment $comment
     * @param  Recipe $recipe
     * @param  Users $user
     * @return void
     */
    public function persistComment(Comment $comment, Recipe $recipe, Users $user)
    {
        $mainComment = $comment->getIdUsers();
    
        $comment->setFlag('w')
            ->setIdRecipe($recipe)
            ->setIdUsers($user)
            ->setDateCreation(new \DateTime('now', new \DateTimeZone('Europe/Paris')));
     
        
        if (!$mainComment) {
           
            $this->manager->persist($comment);
        }
        $this->manager->flush();
    }
}
