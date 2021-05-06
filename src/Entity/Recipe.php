<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idRecipe",type="integer")
     * 
     */
    private $idRecipe;

    /**
     * @ORM\Column(name="dateCreation",type="datetime")
     * 
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     * 
     */
    private $difficulty;

    /**
     * @ORM\Column(type="integer")
     * 
     */
    private $portions;

    /**
     * @ORM\Column(type="string", length=1)
     * 
     */
    private $flag;

    /**
     * @ORM\Column(name="preparationTime",type="integer")
     * 
     */
    private $preparationTime;

    /**
     * @ORM\ManyToOne(targetEntity=Chef::class, inversedBy="recipes")
     * @ORM\JoinColumn(name="idChef",nullable=false, referencedColumnName="idChef")
     * 
     */
    private $idChef;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="idImage", referencedColumnName="idImage")
     * 
     */
    private $idImage;

    /**
     * @ORM\OneToMany(targetEntity=Paragraph::class, mappedBy="idRecipe", orphanRemoval=true)
     * 
     */
    private $paragraphs;

    /**
     * @ORM\OneToMany(targetEntity=IngredientRecipe::class, mappedBy="idRecipe", orphanRemoval=true)
     * 
     */
    private $ingredientRecipes;

    /**
     * @ORM\OneToMany(targetEntity=Grades::class, mappedBy="idRecipe", orphanRemoval=true)
     * 
     */
    private $grades;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="idRecipe", orphanRemoval=true)
     * 
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="recipes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategory", referencedColumnName="id")
     * 
     * })
     */
    private $category;

    public function __construct()
    {
        $this->paragraphs = new ArrayCollection();
        $this->ingredientRecipes = new ArrayCollection();
        $this->grades = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getIdRecipe(): ?int
    {
        return $this->idRecipe;
    }

    public function setIdRecipe(int $idRecipe): self
    {
        $this->idRecipe = $idRecipe;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

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

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getPortions(): ?int
    {
        return $this->portions;
    }

    public function setPortions(int $portions): self
    {
        $this->portions = $portions;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(int $preparationTime): self
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    public function getIdChef(): ?Chef
    {
        return $this->idChef;
    }

    public function setIdChef(?Chef $idChef): self
    {
        $this->idChef = $idChef;

        return $this;
    }

    public function getIdImage(): ?Image
    {
        return $this->idImage;
    }

    public function setIdImage(?Image $idImage): self
    {
        $this->idImage = $idImage;

        return $this;
    }

    /**
     * @return Collection|Paragraph[]
     */
    public function getParagraphs(): Collection
    {
        return $this->paragraphs;
    }

    public function addParagraph(Paragraph $paragraph): self
    {
        if (!$this->paragraphs->contains($paragraph)) {
            $this->paragraphs[] = $paragraph;
            $paragraph->setIdRecipe($this);
        }

        return $this;
    }

    public function removeParagraph(Paragraph $paragraph): self
    {
        if ($this->paragraphs->removeElement($paragraph)) {
            // set the owning side to null (unless already changed)
            if ($paragraph->getIdRecipe() === $this) {
                $paragraph->setIdRecipe(null);
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
            $ingredientRecipe->setIdRecipe($this);
        }

        return $this;
    }

    public function removeIngredientRecipe(IngredientRecipe $ingredientRecipe): self
    {
        if ($this->ingredientRecipes->removeElement($ingredientRecipe)) {
            // set the owning side to null (unless already changed)
            if ($ingredientRecipe->getIdRecipe() === $this) {
                $ingredientRecipe->setIdRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Grades[]
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }
    public function getTotalGrades()
    {
        $total = 0;
        $grades = $this->getGrades();
        foreach ($grades as $value) {
            $total += $value->getRating();
        }
        if(count($grades) > 0){
            $total = $total / count($grades);
        }

        return $total;
    }
    public function addGrade(Grades $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades[] = $grade;
            $grade->setIdRecipe($this);
        }

        return $this;
    }

    public function removeGrade(Grades $grade): self
    {
        if ($this->grades->removeElement($grade)) {
            // set the owning side to null (unless already changed)
            if ($grade->getIdRecipe() === $this) {
                $grade->setIdRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIdRecipe($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getIdRecipe() === $this) {
                $comment->setIdRecipe(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
