<?php

namespace App\Entity;

use App\Repository\CommentRepository;
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
     */
    private $idRecipe;
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="comments")
     * @ORM\JoinColumn(name="idUsers",nullable=false, referencedColumnName="idUsers")
     */
    private $idUsers;

    /**
     * @ORM\Column(name="commentTitle",type="string", length=255)
     */
    private $commentTitle;

    /**
     * @ORM\Column(name="commentContent",type="string", length=255)
     */
    private $commentContent;

    /**
     * @ORM\Column(name="dateCreation",type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $flag;

    /**
     * @ORM\ManyToOne(targetEntity=Moderator::class, inversedBy="comments")
     * @ORM\JoinColumn(name="idModerator", referencedColumnName="idModerator")
     */
    private $idModerator;

  

    public function getIdRecipe(): ?Recipe
    {
        return $this->idRecipe;
    }

    public function setIdRecipe(?Recipe $idRecipe): self
    {
        $this->idRecipe = $idRecipe;

        return $this;
    }

    public function getIdUsers(): ?Users
    {
        return $this->idUsers;
    }

    public function setIdUsers(?Users $idUsers): self
    {
        $this->idUsers = $idUsers;

        return $this;
    }

    public function getCommentTitle(): ?string
    {
        return $this->commentTitle;
    }

    public function setCommentTitle(string $commentTitle): self
    {
        $this->commentTitle = $commentTitle;

        return $this;
    }

    public function getCommentContent(): ?string
    {
        return $this->commentContent;
    }

    public function setCommentContent(string $commentContent): self
    {
        $this->commentContent = $commentContent;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    public function getIdModerator(): ?Moderator
    {
        return $this->idModerator;
    }

    public function setIdModerator(?Moderator $idModerator): self
    {
        $this->idModerator = $idModerator;

        return $this;
    }
}
