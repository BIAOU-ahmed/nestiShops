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
     */
    private $idParagraph;

    /**
     * @Groups({"show_recipe", "list_product"})
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @Groups({"show_recipe", "list_product"})
     * @ORM\Column(name="paragraphPosition",type="integer")
     */
    private $paragraphPosition;

    /**
     * @Groups({"show_recipe", "list_product"})
     * @ORM\Column(name="dateCreation",type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="paragraphs")
     * @ORM\JoinColumn(name="idRecipe",nullable=false, referencedColumnName="idRecipe")
     */
    private $idRecipe;

    public function getIdParagraph(): ?int
    {
        return $this->idParagraph;
    }

    public function setIdParagraph(int $idParagraph): self
    {
        $this->idParagraph = $idParagraph;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getParagraphPosition(): ?int
    {
        return $this->paragraphPosition;
    }

    public function setParagraphPosition(int $paragraphPosition): self
    {
        $this->paragraphPosition = $paragraphPosition;

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

    public function getIdRecipe(): ?Recipe
    {
        return $this->idRecipe;
    }

    public function setIdRecipe(?Recipe $idRecipe): self
    {
        $this->idRecipe = $idRecipe;

        return $this;
    }
}
