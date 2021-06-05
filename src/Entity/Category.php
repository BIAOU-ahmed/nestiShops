<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var mixed
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var mixed
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Recipe::class, mappedBy="category")
     * @var mixed
     */
    private $recipes;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->recipes = new ArrayCollection();
    }
    
    /**
     * getId
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }
    
    /**
     * addRecipe
     *
     * @param  Recipe $recipe
     * @return self
     */
    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->setCategory($this);
        }

        return $this;
    }
    
    /**
     * removeRecipe
     *
     * @param  Recipe $recipe
     * @return self
     */
    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getCategory() === $this) {
                $recipe->setCategory(null);
            }
        }

        return $this;
    }
    
        
    /**
     * __toString
     *
     * @return String
     */
    public function __toString():String
    {
        return $this->name;
    }
}
