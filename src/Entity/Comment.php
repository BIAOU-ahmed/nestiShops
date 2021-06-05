<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use App\Repository\GradesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
   
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="comments")
     * @ORM\JoinColumn(name="idRecipe",nullable=false, referencedColumnName="idRecipe")
     * @var mixed
     */
    private $idRecipe;
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="comments")
     * @ORM\JoinColumn(name="idUsers",nullable=false, referencedColumnName="idUsers")
     * @var mixed
     */
    private $idUsers;

    /**
     * @ORM\Column(name="commentTitle", nullable=true, type="string", length=255)
     * @var mixed
     */
    private $commentTitle;

    /**
     * @ORM\Column(name="commentContent", nullable=true, type="string", length=255)
     * @var mixed
     */
    private $commentContent;

    /**
     * @ORM\Column(name="dateCreation",type="datetime")
     * @var mixed
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=1)
     * @var mixed
     */
    private $flag;

    /**
     * @ORM\ManyToOne(targetEntity=Moderator::class, inversedBy="comments")
     * @ORM\JoinColumn(name="idModerator", referencedColumnName="idModerator")
     * @var mixed
     */
    private $idModerator;

  
    
    /**
     * getIdRecipe
     *
     * @return Recipe
     */
    public function getIdRecipe(): ?Recipe
    {
        return $this->idRecipe;
    }
    
    /**
     * setIdRecipe
     *
     * @param  Recipe $idRecipe
     * @return self
     */
    public function setIdRecipe(?Recipe $idRecipe): self
    {
        $this->idRecipe = $idRecipe;

        return $this;
    }
    
    /**
     * getIdUsers
     *
     * @return Users
     */
    public function getIdUsers(): ?Users
    {
        return $this->idUsers;
    }
    
    /**
     * setIdUsers
     *
     * @param  Users $idUsers
     * @return self
     */
    public function setIdUsers(?Users $idUsers): self
    {
        $this->idUsers = $idUsers;

        return $this;
    }
    
    /**
     * getCommentTitle
     *
     * @return string
     */
    public function getCommentTitle(): ?string
    {
        return $this->commentTitle;
    }
    
    /**
     * setCommentTitle
     *
     * @param  String|null $commentTitle
     * @return self
     */
    public function setCommentTitle( $commentTitle): self
    {
        $this->commentTitle = $commentTitle;

        return $this;
    }
    
    /**
     * getCommentContent
     *
     * @return string
     */
    public function getCommentContent(): ?string
    {
        return $this->commentContent;
    }
    
    /**
     * setCommentContent
     *
     * @param  String|null $commentContent
     * @return self
     */
    public function setCommentContent($commentContent): self
    {
        $this->commentContent = $commentContent;

        return $this;
    }
    
    /**
     * getDateCreation
     *
     * @return \DateTimeInterface
     */
    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }
    
    /**
     * setDateCreation
     *
     * @param  \DateTimeInterface $dateCreation
     * @return self
     */
    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }
    
    /**
     * getFlag
     *
     * @return string
     */
    public function getFlag(): ?string
    {
        return $this->flag;
    }
    
    /**
     * setFlag
     *
     * @param  string $flag
     * @return self
     */
    public function setFlag(string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }
    
    /**
     * getIdModerator
     *
     * @return Moderator
     */
    public function getIdModerator(): ?Moderator
    {
        return $this->idModerator;
    }
    
    /**
     * setIdModerator
     *
     * @param  Moderator $idModerator
     * @return self
     */
    public function setIdModerator(?Moderator $idModerator): self
    {
        $this->idModerator = $idModerator;

        return $this;
    }    
    /**
     * getGrade
     *
     * @return float
     */
    public function getGrade():float{
        
        $grade = false;
        foreach ($this->getIdUsers()->getGrades() as $key => $value) {
            
            if($value->getIdRecipe() == $this->getIdRecipe() && $value->getIdUsers() == $this->getIdUsers()){
                
                $grade = $value->getRating();
            }
        }
        return $grade;
    }
}
