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
     * @ORM\OneToOne(targetEntity=Product::class, inversedBy="ingredient", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="idIngredient", nullable=false, referencedColumnName="idProduct")
     */
    private $idIngredient;

    /**
     * @ORM\OneToMany(targetEntity=IngredientRecipe::class, mappedBy="idProduct")
     */
    private $ingredientRecipes;

    public function __construct()
    {
        $this->ingredientRecipes = new ArrayCollection();
    }

  

    public function getIdIngredient(): ?Product
    {
        return $this->idIngredient;
    }

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

    public function addIngredientRecipe(IngredientRecipe $ingredientRecipe): self
    {
        if (!$this->ingredientRecipes->contains($ingredientRecipe)) {
            $this->ingredientRecipes[] = $ingredientRecipe;
            $ingredientRecipe->setIdProduct($this);
        }

        return $this;
    }

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
