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
     * @var mixed
     * 
     */
    private $idRecipe;

    /**
     * @ORM\Column(name="dateCreation",type="datetime")
     * @var mixed
     * 
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255)
     * @var mixed
     * 
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     * @var mixed
     * 
     */
    private $difficulty;

    /**
     * @ORM\Column(type="integer")
     * @var mixed
     * 
     */
    private $portions;

    /**
     * @ORM\Column(type="string", length=1)
     * @var mixed
     * 
     */
    private $flag;

    /**
     * @ORM\Column(name="preparationTime",type="integer")
     * @var mixed
     * 
     */
    private $preparationTime;

    /**
     * @ORM\ManyToOne(targetEntity=Chef::class, inversedBy="recipes")
     * @ORM\JoinColumn(name="idChef",nullable=false, referencedColumnName="idChef")
     * @var mixed
     * 
     */
    private $idChef;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="idImage", referencedColumnName="idImage")
     * @var mixed
     * 
     */
    private $idImage;

    /**
     * @ORM\OneToMany(targetEntity=Paragraph::class, mappedBy="idRecipe", orphanRemoval=true)
     * @var mixed
     * 
     */
    private $paragraphs;

    /**
     * @ORM\OneToMany(targetEntity=IngredientRecipe::class, mappedBy="idRecipe", orphanRemoval=true)
     * @var mixed
     * 
     */
    private $ingredientRecipes;

    /**
     * @ORM\OneToMany(targetEntity=Grades::class, mappedBy="idRecipe", orphanRemoval=true)
     * @var mixed
     * 
     */
    private $grades;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="idRecipe", orphanRemoval=true)
     * @var mixed
     * 
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="recipes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategory", referencedColumnName="id")
     * 
     * })
     * @var mixed
     */
    private $category;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->paragraphs = new ArrayCollection();
        $this->ingredientRecipes = new ArrayCollection();
        $this->grades = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }
    
    /**
     * getIdRecipe
     *
     * @return int
     */
    public function getIdRecipe(): ?int
    {
        return $this->idRecipe;
    }
    
    /**
     * setIdRecipe
     *
     * @param  int $idRecipe
     * @return self
     */
    public function setIdRecipe(int $idRecipe): self
    {
        $this->idRecipe = $idRecipe;

        return $this;
    }
    
    /**
     * getDateCreation
     *
     * @return \DateTimeInterface
     */
    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }
    
    /**
     * setDateCreation
     *
     * @param  \DateTimeInterface $dateCreation
     * @return self
     */
    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

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
     * getDifficulty
     *
     * @return int
     */
    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }
    
    /**
     * setDifficulty
     *
     * @param  int $difficulty
     * @return self
     */
    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }
    
    /**
     * getPortions
     *
     * @return int
     */
    public function getPortions(): ?int
    {
        return $this->portions;
    }
    
    /**
     * setPortions
     *
     * @param  int $portions
     * @return self
     */
    public function setPortions(int $portions): self
    {
        $this->portions = $portions;

        return $this;
    }
    
    /**
     * getFlag
     *
     * @return string
     */
    public function getFlag(): ?string
    {
        return $this->flag;
    }
    
    /**
     * setFlag
     *
     * @param  string $flag
     * @return self
     */
    public function setFlag(string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }
    
    /**
     * getPreparationTime
     *
     * @return int
     */
    public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }
    
    /**
     * setPreparationTime
     *
     * @param  int $preparationTime
     * @return self
     */
    public function setPreparationTime(int $preparationTime): self
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }
    
    /**
     * getIdChef
     *
     * @return Chef
     */
    public function getIdChef(): ?Chef
    {
        return $this->idChef;
    }
    
    /**
     * setIdChef
     *
     * @param  Chef $idChef
     * @return self
     */
    public function setIdChef(?Chef $idChef): self
    {
        $this->idChef = $idChef;

        return $this;
    }
    
    /**
     * getIdImage
     *
     * @return Image
     */
    public function getIdImage(): ?Image
    {
        return $this->idImage;
    }
    
    /**
     * setIdImage
     *
     * @param  Image $idImage
     * @return self
     */
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
    
    /**
     * addParagraph
     *
     * @param  Paragraph $paragraph
     * @return self
     */
    public function addParagraph(Paragraph $paragraph): self
    {
        if (!$this->paragraphs->contains($paragraph)) {
            $this->paragraphs[] = $paragraph;
            $paragraph->setIdRecipe($this);
        }

        return $this;
    }
    
    /**
     * removeParagraph
     *
     * @param  Paragraph $paragraph
     * @return self
     */
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
            $ingredientRecipe->setIdRecipe($this);
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
    /**
     * getTotalGrades
     *
     * @return float
     */
    public function getTotalGrades():float
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
    /**
     * addGrade
     *
     * @param  Grades $grade
     * @return self
     */
    public function addGrade(Grades $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades[] = $grade;
            $grade->setIdRecipe($this);
        }

        return $this;
    }
    
    /**
     * removeGrade
     *
     * @param  Grades $grade
     * @return self
     */
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
    
    /**
     * addComment
     *
     * @param  Comment $comment
     * @return self
     */
    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIdRecipe($this);
        }

        return $this;
    }
    
    /**
     * removeComment
     *
     * @param  Comment $comment
     * @return self
     */
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
    
    /**
     * getCategory
     *
     * @return Category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }
    
    /**
     * setCategory
     *
     * @param  Category $category
     * @return self
     */
    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
    
    /**
     * getImageName
     *
     * @return String
     */
    public function getImageName(): ?String
    {
        $imageName = "noImage.jpg";
        if($this->getIdImage()){
            $imageName = "recipes/".$this->getIdImage()->getName().'.'.$this->getIdImage()->getFileExtension();
        }
        return $imageName;
    }
    
    /**
     * getAuthor
     *
     * @return String
     */
    public function getAuthor():String{
        return $this->getIdChef()->getIdChef()->getFirstName().' '.$this->getIdChef()->getIdChef()->getLastName();
    }    
    /**
     * getDisplayDifficulty
     *
     * @return String
     */
    public function getDisplayDifficulty():String{
        $difficulty = "Facile";

        if($this->getDifficulty()>=4){
            $difficulty = "Dificile";
        }else if($this->getDifficulty()>2){
            $difficulty = "Moyen";
        }
        return $difficulty;
    }    
    /**
     * getTime
     *
     * @return String
     */
    public function getTime():String
    {
        $time = (int) $this->getPreparationTime();
        $hour = (String) intdiv($time, 60);
        $min = (String) fmod($time, 60);
        $hour = ltrim($hour, "0");
        $min = ltrim($min, "0");
        // $hour = (String) ((int)$hour) ;

        $hour = $hour ? $hour . 'h' : '';
        $min = $min ? $min . 'min' : '';

        $displayTime = $hour . $min;
        return $displayTime;
    }

}
