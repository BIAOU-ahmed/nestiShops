<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
 

    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity=Product::class, inversedBy="ingredient", cascade={"persist", "remove"}, fetch="EAGER")
     * @ORM\JoinColumn(name="idIngredient", nullable=false, referencedColumnName="idProduct")
     * @var mixed
     */
    private $idIngredient;

    /**
     * @ORM\OneToMany(targetEntity=IngredientRecipe::class, mappedBy="idProduct")
     * @var mixed
     */
    private $ingredientRecipes;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->ingredientRecipes = new ArrayCollection();
    }

  
    
    /**
     * getIdIngredient
     *
     * @return Product
     */
    public function getIdIngredient(): ?Product
    {
        return $this->idIngredient;
    }
    
    /**
     * setIdIngredient
     *
     * @param  Product $idIngredient
     * @return self
     */
    public function setIdIngredient(Product $idIngredient): self
    {
        $this->idIngredient = $idIngredient;

        return $this;
    }

    /**
     * @return Collection|IngredientRecipe[]
     */
    public function getIngredientRecipes(): Collection
    {
        return $this->ingredientRecipes;
    }
    
    /**
     * addIngredientRecipe
     *
     * @param  IngredientRecipe $ingredientRecipe
     * @return self
     */
    public function addIngredientRecipe(IngredientRecipe $ingredientRecipe): self
    {
        if (!$this->ingredientRecipes->contains($ingredientRecipe)) {
            $this->ingredientRecipes[] = $ingredientRecipe;
            $ingredientRecipe->setIdProduct($this);
        }

        return $this;
    }
    
    /**
     * removeIngredientRecipe
     *
     * @param  IngredientRecipe $ingredientRecipe
     * @return self
     */
    public function removeIngredientRecipe(IngredientRecipe $ingredientRecipe): self
    {
        if ($this->ingredientRecipes->removeElement($ingredientRecipe)) {
            // set the owning side to null (unless already changed)
            if ($ingredientRecipe->getIdProduct() === $this) {
                $ingredientRecipe->setIdProduct(null);
            }
        }

        return $this;
    }
}
