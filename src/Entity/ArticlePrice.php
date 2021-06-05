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
     * @var mixed
     */
    private $idArticlePrice;

    /**
     * @ORM\Column(name="dateStart",type="datetime")
     * @var mixed
     */
    private $dateStart;

    /**
     * @ORM\Column(type="float")
     * @var mixed
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="articlePrices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idArticle", referencedColumnName="idArticle")
     * })
     * @var mixed
     */
    private $idArticle;

  
    
    /**
     * getIdArticlePrice
     *
     * @return int
     */
    public function getIdArticlePrice(): ?int
    {
        return $this->idArticlePrice;
    }
    
    /**
     * setIdArticlePrice
     *
     * @param  int $idArticlePrice
     * @return self
     */
    public function setIdArticlePrice(int $idArticlePrice): self
    {
        $this->idArticlePrice = $idArticlePrice;

        return $this;
    }
    
    /**
     * getDateStart
     *
     * @return \DateTimeInterface
     */
    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }
    
    /**
     * setDateStart
     *
     * @param  \DateTimeInterface $dateStart
     * @return self
     */
    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }
    
    /**
     * getPrice
     *
     * @return float
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }
    
    /**
     * setPrice
     *
     * @param  float $price
     * @return self
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
    
    /**
     * getIdArticle
     *
     * @return Article
     */
    public function getIdArticle(): ?Article
    {
        return $this->idArticle;
    }
    
    /**
     * setIdArticle
     *
     * @param  Article $idArticle
     * @return self
     */
    public function setIdArticle(?Article $idArticle): self
    {
        $this->idArticle = $idArticle;

        return $this;
    }
}
