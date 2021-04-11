<?php

namespace App\Entity;

use App\Repository\GradesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GradesRepository::class)
 */
class Grades
{
   
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="grades")
     * @ORM\JoinColumn(name="idUsers",nullable=false, referencedColumnName="idUsers")
     */
    private $idUsers;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="grades")
     * @ORM\JoinColumn(name="idRecipe",nullable=false, referencedColumnName="idRecipe")
     */
    private $idRecipe;

    /**
     * @ORM\Column(type="float")
     */
    private $rating;

  

    public function getIdUsers(): ?Users
    {
        return $this->idUsers;
    }

    public function setIdUsers(?Users $idUsers): self
    {
        $this->idUsers = $idUsers;

        return $this;
    }

    public function getIdRecipe(): ?Recipe
    {
        return $this->idRecipe;
    }

    public function setIdRecipe(?Recipe $idRecipe): self
    {
        $this->idRecipe = $idRecipe;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }
}
