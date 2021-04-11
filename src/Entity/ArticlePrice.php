<?php

namespace App\Entity;

use App\Repository\ArticlePriceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="articleprice")
 * @ORM\Entity(repositoryClass=ArticlePriceRepository::class)
 */
class ArticlePrice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idArticlePrice", type="integer")
     */
    private $idArticlePrice;

    /**
     * @ORM\Column(name="dateStart",type="datetime")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="articlePrices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idArticle", referencedColumnName="idArticle")
     * })
     */
    private $idArticle;

  

    public function getIdArticlePrice(): ?int
    {
        return $this->idArticlePrice;
    }

    public function setIdArticlePrice(int $idArticlePrice): self
    {
        $this->idArticlePrice = $idArticlePrice;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIdArticle(): ?Article
    {
        return $this->idArticle;
    }

    public function setIdArticle(?Article $idArticle): self
    {
        $this->idArticle = $idArticle;

        return $this;
    }
}
