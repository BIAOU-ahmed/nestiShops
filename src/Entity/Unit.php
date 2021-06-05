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
     * @var mixed
     */
    private $idUnit;

    /**
     * @ORM\Column(type="string", length=255)
     * @var mixed
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="idUnit")
     * @var mixed
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity=IngredientRecipe::class, mappedBy="idUnit")
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
        $this->articles = new ArrayCollection();
        $this->ingredientRecipes = new ArrayCollection();
    }
    
    /**
     * getIdUnit
     *
     * @return int
     */
    public function getIdUnit(): ?int
    {
        return $this->idUnit;
    }
    
    /**
     * setIdUnit
     *
     * @param  int $idUnit
     * @return self
     */
    public function setIdUnit(int $idUnit): self
    {
        $this->idUnit = $idUnit;

        return $this;
    }
    
    /**
     * getName
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    
    /**
     * setName
     *
     * @param  string $name
     * @return self
     */
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
    
    /**
     * addArticle
     *
     * @param  Article $article
     * @return self
     */
    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setIdUnit($this);
        }

        return $this;
    }
    
    /**
     * removeArticle
     *
     * @param  Article $article
     * @return self
     */
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
            $ingredientRecipe->setIdUnit($this);
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
            if ($ingredientRecipe->getIdUnit() === $this) {
                $ingredientRecipe->setIdUnit(null);
            }
        }

        return $this;
    }
}
