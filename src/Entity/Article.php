<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast;
use PhpParser\Node\Expr\Cast\Double;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{

    /**
     * @ORM\Id
     * @ORM\Column(name="idArticle",type="integer")
     * @var mixed
     */
    private $idArticle;

    /**
     * @ORM\Column(name="unitQuantity",type="smallint")
     * @var mixed
     */
    private $unitQuantity;

    /**
     * @ORM\Column(type="string", length=1)
     * @var mixed
     */
    private $flag;

    /**
     * @ORM\Column(name="dateCreation",type="datetime")
     * @var mixed
     */
    private $dateCreation;

    /**
     * @ORM\Column(name="dateModification",type="datetime", nullable=true)
     * @var mixed
     */
    private $dateModification;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idImage", referencedColumnName="idImage")
     * })
     * @var mixed
     */
    private $idImage;

    /**
     * @ORM\ManyToOne(targetEntity=Unit::class, inversedBy="articles")
     * @ORM\JoinColumn(name="idUnit",nullable=false, referencedColumnName="idUnit")
     * @var mixed
     */
    private $idUnit;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="articles")
     * @ORM\JoinColumn(name="idProduct",nullable=false, referencedColumnName="idProduct")
     * @var mixed
     */
    private $idProduct;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var mixed
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=OrderLine::class, mappedBy="idArticle", orphanRemoval=true)
     * @var mixed
     */
    private $orderLines;

    /**
     * @ORM\OneToMany(targetEntity=Lot::class, mappedBy="idArticle", orphanRemoval=true)
     * @var mixed
     */
    private $lots;

    /**
     * @ORM\OneToMany(targetEntity=ArticlePrice::class, mappedBy="idArticle", orphanRemoval=true)
     * @ORM\OrderBy({"dateStart" = "DESC"})
     * @var mixed
     */
    private $articlePrices;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->orderLines = new ArrayCollection();
        $this->lots = new ArrayCollection();
        $this->articlePrices = new ArrayCollection();
    }


    
    /**
     * getIdArticle
     *
     * @return int
     */
    public function getIdArticle(): ?int
    {
        return $this->idArticle;
    }
    
    /**
     * setIdArticle
     *
     * @param  int $idArticle
     * @return self
     */
    public function setIdArticle(int $idArticle): self
    {
        $this->idArticle = $idArticle;

        return $this;
    }
    
    /**
     * getUnitQuantity
     *
     * @return int
     */
    public function getUnitQuantity(): ?int
    {
        return $this->unitQuantity;
    }
    
    /**
     * setUnitQuantity
     *
     * @param  int $unitQuantity
     * @return self
     */
    public function setUnitQuantity(int $unitQuantity): self
    {
        $this->unitQuantity = $unitQuantity;

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
     * getDateModification
     *
     * @return \DateTimeInterface
     */
    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->dateModification;
    }
    
    /**
     * setDateModification
     *
     * @param  \DateTimeInterface $dateModification
     * @return self
     */
    public function setDateModification(?\DateTimeInterface $dateModification): self
    {
        $this->dateModification = $dateModification;

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
     * getIdUnit
     *
     * @return Unit
     */
    public function getIdUnit(): ?Unit
    {
        return $this->idUnit;
    }
    
    /**
     * setIdUnit
     *
     * @param  Unit $idUnit
     * @return self
     */
    public function setIdUnit(?Unit $idUnit): self
    {
        $this->idUnit = $idUnit;

        return $this;
    }
    
    /**
     * getIdProduct
     *
     * @return Product
     */
    public function getIdProduct(): ?Product
    {
        return $this->idProduct;
    }
    
    /**
     * setIdProduct
     *
     * @param  Product $idProduct
     * @return self
     */
    public function setIdProduct(?Product $idProduct): self
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
     * @param  string|null $name
     * @return self
     */
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
    
    /**
     * addOrderLine
     *
     * @param  OrderLine $orderLine
     * @return self
     */
    public function addOrderLine(OrderLine $orderLine): self
    {
        if (!$this->orderLines->contains($orderLine)) {
            $this->orderLines[] = $orderLine;
            $orderLine->setIdArticle($this);
        }

        return $this;
    }
    
    /**
     * removeOrderLine
     *
     * @param  OrderLine $orderLine
     * @return self
     */
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
    
    /**
     * addLot
     *
     * @param  Lot $lot
     * @return self
     */
    public function addLot(Lot $lot): self
    {
        if (!$this->lots->contains($lot)) {
            $this->lots[] = $lot;
            $lot->setIdArticle($this);
        }

        return $this;
    }
    
    /**
     * removeLot
     *
     * @param  Lot $lot
     * @return self
     */
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
    
    /**
     * addArticlePrice
     *
     * @param  ArticlePrice $articlePrice
     * @return self
     */
    public function addArticlePrice(ArticlePrice $articlePrice): self
    {
        if (!$this->articlePrices->contains($articlePrice)) {
            $this->articlePrices[] = $articlePrice;
            $articlePrice->setIdArticle($this);
        }

        return $this;
    }
    
    /**
     * removeArticlePrice
     *
     * @param  ArticlePrice $articlePrice
     * @return self
     */
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
    
    /**
     * getPrice
     *
     * @return float
     */
    public function getPrice():float
    {
        
        $arrayArticlePrice = $this->getArticlePrices();

        return $arrayArticlePrice[0]->getPrice();
    }
    
    /**
     * getLastPriceAt
     *
     * @param  string $dateMax
     * @return float
     */
    public function getLastPriceAt(string $dateMax): float
    {

        $maxDate = 0;
        $arrayArticlePrice = $this->getArticlePrices();
        $price = 0;
        foreach ($arrayArticlePrice as $value) {
            $date = strtotime($value->getDateStart()->format('Y-m-d'));
            if ($date <= $dateMax) {
                if ($maxDate < $date) {
                    $maxDate = $date;
                    $price = $value->getPrice();
                }
            }
        }
        return $price;
    }
    
    
    /**
     * getNbBought
     *
     * @return int
     */
    public function getNbBought():int
    {
        $totalQuantity = 0;
        foreach ($this->getLots() as $lot) {
            $totalQuantity += $lot->getQuantity();
        }
        
        return (int)$totalQuantity;
    }
    
    /**
     * getNbOrdered
     *
     * @return int
     */
    public function getNbOrdered():int
    {
        $totalQuantity = 0;
        foreach ($this->getOrderLines() as $orderLine) {
            if ($orderLine->getIdOrders()->getFlag() != "b") {
                $totalQuantity += $orderLine->getQuantity();
            }
        }
        

        return $totalQuantity;
    }
        
    /**
     * getInventory
     *
     * @return float
     */
    public function getInventory():float
    {
        return $this->getNbBought() - $this->getNbOrdered();
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
            $imageName = "articles/".$this->getIdImage()->getName().'.'.$this->getIdImage()->getFileExtension();
        }
        return $imageName;
    }

    public function getDisplayName(): ?String{
        $name = $this->unitQuantity . ' ' . $this->getIdUnit()->getName() . ' de ' . $this->getIdProduct()->getName();
        return $this->getName() != '' ? $this->getName() :$name;
    }
}
