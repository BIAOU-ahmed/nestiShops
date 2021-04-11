<?php

namespace App\Entity;

use App\Repository\IngredientRecipeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ingredientrecipe")
 * @ORM\Entity(repositoryClass=IngredientRecipeRepository::class)
 */
class IngredientRecipe
{
  
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Ingredient::class, inversedBy="ingredientRecipes")
     * @ORM\JoinColumn(name="idProduct",nullable=false, referencedColumnName="idIngredient")
     */
    private $idProduct;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="ingredientRecipes")
     * @ORM\JoinColumn(name="idRecipe",nullable=false, referencedColumnName="idRecipe")
     */
    private $idRecipe;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(name="recipePosition",type="integer")
     */
    private $recipePosition;

    /**
     * @ORM\ManyToOne(targetEntity=Unit::class, inversedBy="ingredientRecipes")
     * @ORM\JoinColumn(name="idUnit",nullable=false, referencedColumnName="idUnit")
     */
    private $idUnit;

  

    public function getIdProduct(): ?Ingredient
    {
        return $this->idProduct;
    }

    public function setIdProduct(?Ingredient $idProduct): self
    {
        $this->idProduct = $idProduct;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getRecipePosition(): ?int
    {
        return $this->recipePosition;
    }

    public function setRecipePosition(int $recipePosition): self
    {
        $this->recipePosition = $recipePosition;

        return $this;
    }

    public function getIdUnit(): ?Unit
    {
        return $this->idUnit;
    }

    public function setIdUnit(?Unit $idUnit): self
    {
        $this->idUnit = $idUnit;

        return $this;
    }
}
