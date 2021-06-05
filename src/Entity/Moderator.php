<?php

namespace App\Entity;

use App\Repository\ModeratorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModeratorRepository::class)
 */
class Moderator
{

    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity=Users::class, inversedBy="moderator", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="idModerator", nullable=false, referencedColumnName="idUsers")
     * @var mixed
     */
    private $idModerator;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="idModerator")
     * @var mixed
     */
    private $comments;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }
    
    /**
     * getIdModerator
     *
     * @return Users
     */
    public function getIdModerator(): ?Users
    {
        return $this->idModerator;
    }
    
    /**
     * setIdModerator
     *
     * @param  Users $idModerator
     * @return self
     */
    public function setIdModerator(?Users $idModerator): self
    {
        $this->idModerator = $idModerator;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }
    
    /**
     * addComment
     *
     * @param  Comment $comment
     * @return self
     */
    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIdModerator($this);
        }

        return $this;
    }
    
    /**
     * removeComment
     *
     * @param  Comment $comment
     * @return self
     */
    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getIdModerator() === $this) {
                $comment->setIdModerator(null);
            }
        }

        return $this;
    }
}
