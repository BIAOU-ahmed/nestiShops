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
     * @ORM\ManyToOne(targetEntity=Ingredient::class, inversedBy="ingredientRecipes", fetch="EAGER")
     * @ORM\JoinColumn(name="idProduct",nullable=false, referencedColumnName="idIngredient")
     * @var mixed
     */
    private $idProduct;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="ingredientRecipes")
     * @ORM\JoinColumn(name="idRecipe",nullable=false, referencedColumnName="idRecipe")
     * @var mixed
     */
    private $idRecipe;

    /**
     * @ORM\Column(type="integer")
     * @var mixed
     */
    private $quantity;

    /**
     * @ORM\Column(name="recipePosition",type="integer")
     * @var mixed
     */
    private $recipePosition;

    /**
     * @ORM\ManyToOne(targetEntity=Unit::class, inversedBy="ingredientRecipes", fetch="EAGER")
     * @ORM\JoinColumn(name="idUnit",nullable=false, referencedColumnName="idUnit")
     * @var mixed
     */
    private $idUnit;


    
    /**
     * getIdProduct
     *
     * @return Ingredient
     */
    public function getIdProduct(): ?Ingredient
    {
        return $this->idProduct;
    }
    
    /**
     * setIdProduct
     *
     * @param  Ingredient $idProduct
     * @return self
     */
    public function setIdProduct(?Ingredient $idProduct): self
    {
        $this->idProduct = $idProduct;

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
     * getQuantity
     *
     * @return int
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }
    
    /**
     * setQuantity
     *
     * @param  int $quantity
     * @return self
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
    
    /**
     * getRecipePosition
     *
     * @return int
     */
    public function getRecipePosition(): ?int
    {
        return $this->recipePosition;
    }
    
    /**
     * setRecipePosition
     *
     * @param  int $recipePosition
     * @return self
     */
    public function setRecipePosition(int $recipePosition): self
    {
        $this->recipePosition = $recipePosition;

        return $this;
    }
    
    /**
     * getIdUnit
     *
     * @return Unit
     */
    public function getIdUnit(): ?Unit
    {
        return $this->idUnit;
    }
    
    /**
     * setIdUnit
     *
     * @param  Unit $idUnit
     * @return self
     */
    public function setIdUnit(?Unit $idUnit): self
    {
        $this->idUnit = $idUnit;

        return $this;
    }
    
      
    /**
     * getDisplayName
     *
     * @return String
     */
    public function getDisplayName():String {
      return $this->getQuantity().' '.$this->getIdUnit()->getName().' '.$this->getIdProduct()->getIdIngredient()->getName();
    }
}
