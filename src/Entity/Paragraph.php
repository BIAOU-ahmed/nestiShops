<?php

namespace App\Entity;

use App\Repository\ParagraphRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ParagraphRepository::class)
 */
class Paragraph
{
   
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idParagraph",type="integer")
     * @Groups({"show_recipe", "list_product"})
     * @var mixed
     */
    private $idParagraph;

    /**
     * @Groups({"show_recipe", "list_product"})
     * @ORM\Column(type="string", length=255)
     * @var mixed
     */
    private $content;

    /**
     * @Groups({"show_recipe", "list_product"})
     * @ORM\Column(name="paragraphPosition",type="integer")
     * @var mixed
     */
    private $paragraphPosition;

    /**
     * @Groups({"show_recipe", "list_product"})
     * @ORM\Column(name="dateCreation",type="datetime")
     * @var mixed
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="paragraphs")
     * @ORM\JoinColumn(name="idRecipe",nullable=false, referencedColumnName="idRecipe")
     * @var mixed
     */
    private $idRecipe;
    
    /**
     * getIdParagraph
     *
     * @return int
     */
    public function getIdParagraph(): ?int
    {
        return $this->idParagraph;
    }
    
    /**
     * setIdParagraph
     *
     * @param  int $idParagraph
     * @return self
     */
    public function setIdParagraph(int $idParagraph): self
    {
        $this->idParagraph = $idParagraph;

        return $this;
    }
    
    /**
     * getContent
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }
    
    /**
     * setContent
     *
     * @param  string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
    
    /**
     * getParagraphPosition
     *
     * @return int
     */
    public function getParagraphPosition(): ?int
    {
        return $this->paragraphPosition;
    }
    
    /**
     * setParagraphPosition
     *
     * @param  int $paragraphPosition
     * @return self
     */
    public function setParagraphPosition(int $paragraphPosition): self
    {
        $this->paragraphPosition = $paragraphPosition;

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
}
