<?php

namespace App\Entity;

use App\Repository\UnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnitRepository::class)
 */
class Unit
{
 
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idUnit",type="integer")
     */
    private $idUnit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="idUnit")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity=IngredientRecipe::class, mappedBy="idUnit")
     */
    private $ingredientRecipes;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->ingredientRecipes = new ArrayCollection();
    }

    public function getIdUnit(): ?int
    {
        return $this->idUnit;
    }

    public function setIdUnit(int $idUnit): self
    {
        $this->idUnit = $idUnit;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setIdUnit($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getIdUnit() === $this) {
                $article->setIdUnit(null);
            }
        }

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
            $ingredientRecipe->setIdUnit($this);
        }

        return $this;
    }

    public function removeIngredientRecipe(IngredientRecipe $ingredientRecipe): self
    {
        if ($this->ingredientRecipes->removeElement($ingredientRecipe)) {
            // set the owning side to null (unless already changed)
            if ($ingredientRecipe->getIdUnit() === $this) {
                $ingredientRecipe->setIdUnit(null);
            }
        }

        return $this;
    }
}
