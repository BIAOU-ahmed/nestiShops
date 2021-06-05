<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idProduct",type="integer")
     * @var mixed
     */
    private $idProduct;

    /**
     * @ORM\Column(type="string", length=255)
     * @var mixed
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=Ingredient::class, mappedBy="idIngredient", cascade={"persist", "remove"})
     * @var mixed
     */
    private $ingredient;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="idProduct", orphanRemoval=true)
     * @var mixed
     */
    private $articles;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }
    
    /**
     * getIdProduct
     *
     * @return int
     */
    public function getIdProduct(): ?int
    {
        return $this->idProduct;
    }
    
    /**
     * setIdProduct
     *
     * @param  int $idProduct
     * @return self
     */
    public function setIdProduct(int $idProduct): self
    {
        $this->idProduct = $idProduct;

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
     * getIngredient
     *
     * @return Ingredient
     */
    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }
    
    /**
     * setIngredient
     *
     * @param  Ingredient $ingredient
     * @return self
     */
    public function setIngredient(Ingredient $ingredient): self
    {
        // set the owning side of the relation if necessary
        if ($ingredient->getIdIngredient() !== $this) {
            $ingredient->setIdIngredient($this);
        }

        $this->ingredient = $ingredient;

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
            $article->setIdProduct($this);
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
            if ($article->getIdProduct() === $this) {
                $article->setIdProduct(null);
            }
        }

        return $this;
    }
}
