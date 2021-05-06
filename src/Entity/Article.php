<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{

    /**
     * @ORM\Id
     * @ORM\Column(name="idArticle",type="integer")
     */
    private $idArticle;

    /**
     * @ORM\Column(name="unitQuantity",type="smallint")
     */
    private $unitQuantity;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $flag;

    /**
     * @ORM\Column(name="dateCreation",type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(name="dateModification",type="datetime", nullable=true)
     */
    private $dateModification;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idImage", referencedColumnName="idImage")
     * })
     */
    private $idImage;

    /**
     * @ORM\ManyToOne(targetEntity=Unit::class, inversedBy="articles")
     * @ORM\JoinColumn(name="idUnit",nullable=false, referencedColumnName="idUnit")
     */
    private $idUnit;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="articles")
     * @ORM\JoinColumn(name="idProduct",nullable=false, referencedColumnName="idProduct")
     */
    private $idProduct;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=OrderLine::class, mappedBy="idArticle", orphanRemoval=true)
     */
    private $orderLines;

    /**
     * @ORM\OneToMany(targetEntity=Lot::class, mappedBy="idArticle", orphanRemoval=true)
     */
    private $lots;

    /**
     * @ORM\OneToMany(targetEntity=ArticlePrice::class, mappedBy="idArticle", orphanRemoval=true)
     * @ORM\OrderBy({"dateStart" = "DESC"})
     */
    private $articlePrices;

    public function __construct()
    {
        $this->orderLines = new ArrayCollection();
        $this->lots = new ArrayCollection();
        $this->articlePrices = new ArrayCollection();
    }



    public function getIdArticle(): ?int
    {
        return $this->idArticle;
    }

    public function setIdArticle(int $idArticle): self
    {
        $this->idArticle = $idArticle;

        return $this;
    }

    public function getUnitQuantity(): ?int
    {
        return $this->unitQuantity;
    }

    public function setUnitQuantity(int $unitQuantity): self
    {
        $this->unitQuantity = $unitQuantity;

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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->dateModification;
    }

    public function setDateModification(?\DateTimeInterface $dateModification): self
    {
        $this->dateModification = $dateModification;

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

    public function getIdUnit(): ?Unit
    {
        return $this->idUnit;
    }

    public function setIdUnit(?Unit $idUnit): self
    {
        $this->idUnit = $idUnit;

        return $this;
    }

    public function getIdProduct(): ?Product
    {
        return $this->idProduct;
    }

    public function setIdProduct(?Product $idProduct): self
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|OrderLine[]
     */
    public function getOrderLines(): Collection
    {
        return $this->orderLines;
    }

    public function addOrderLine(OrderLine $orderLine): self
    {
        if (!$this->orderLines->contains($orderLine)) {
            $this->orderLines[] = $orderLine;
            $orderLine->setIdArticle($this);
        }

        return $this;
    }

    public function removeOrderLine(OrderLine $orderLine): self
    {
        if ($this->orderLines->removeElement($orderLine)) {
            // set the owning side to null (unless already changed)
            if ($orderLine->getIdArticle() === $this) {
                $orderLine->setIdArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lot[]
     */
    public function getLots(): Collection
    {
        return $this->lots;
    }

    public function addLot(Lot $lot): self
    {
        if (!$this->lots->contains($lot)) {
            $this->lots[] = $lot;
            $lot->setIdArticle($this);
        }

        return $this;
    }

    public function removeLot(Lot $lot): self
    {
        if ($this->lots->removeElement($lot)) {
            // set the owning side to null (unless already changed)
            if ($lot->getIdArticle() === $this) {
                $lot->setIdArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArticlePrice[]
     */
    public function getArticlePrices(): Collection
    {
        return $this->articlePrices;
    }

    public function addArticlePrice(ArticlePrice $articlePrice): self
    {
        if (!$this->articlePrices->contains($articlePrice)) {
            $this->articlePrices[] = $articlePrice;
            $articlePrice->setIdArticle($this);
        }

        return $this;
    }

    public function removeArticlePrice(ArticlePrice $articlePrice): self
    {
        if ($this->articlePrices->removeElement($articlePrice)) {
            // set the owning side to null (unless already changed)
            if ($articlePrice->getIdArticle() === $this) {
                $articlePrice->setIdArticle(null);
            }
        }

        return $this;
    }

    public function getPrice()
    {
        $maxDate = 0;
        $arrayArticlePrice = $this->getArticlePrices();

        foreach ($arrayArticlePrice as $value) {
            dump($value);
            // $date =   strtotime($value->getDateStart());
            // if ($maxDate <  $date) {
            //     $maxDate =  $date;
            //     $price = $value->getPrice();
            // }
        }
        return $arrayArticlePrice[0]->getPrice();
    }
}
