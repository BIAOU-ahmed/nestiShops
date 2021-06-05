<?php

namespace App\Entity;

use App\Repository\ChefRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChefRepository::class)
 */
class Chef
{

    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity=Users::class, inversedBy="chef", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idChef", referencedColumnName="idUsers")
     * })
     * @var mixed
     */
    private $idChef;

    /**
     * @ORM\OneToMany(targetEntity=Recipe::class, mappedBy="idChef", orphanRemoval=true)
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
     * getIdChef
     *
     * @return Users
     */
    public function getIdChef(): ?Users
    {
        return $this->idChef;
    }
    
    /**
     * setIdChef
     *
     * @param  Users $idChef
     * @return self
     */
    public function setIdChef(?Users $idChef): self
    {
        $this->idChef = $idChef;

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
            $recipe->setIdChef($this);
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
            if ($recipe->getIdChef() === $this) {
                $recipe->setIdChef(null);
            }
        }

        return $this;
    }
}
