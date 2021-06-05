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
     * @var mixed
     */
    private $idUsers;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="grades")
     * @ORM\JoinColumn(name="idRecipe",nullable=false, referencedColumnName="idRecipe")
     * @var mixed
     */
    private $idRecipe;

    /**
     * @ORM\Column(type="float")
     * @var mixed
     */
    private $rating;

    /**
     * @ORM\Column(type="datetime")
     * @var mixed
     */
    private $dateCreation;

  
    
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
     * getRating
     *
     * @return float
     */
    public function getRating(): ?float
    {
        return $this->rating;
    }
    
    /**
     * setRating
     *
     * @param  float $rating
     * @return self
     */
    public function setRating(float $rating): self
    {
        $this->rating = $rating;

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
}
