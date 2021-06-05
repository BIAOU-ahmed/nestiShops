<?php

namespace App\Entity;

use App\Repository\LotRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LotRepository::class)
 */
class Lot
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="lots")
     * @ORM\JoinColumn(name="idArticle",nullable=false, referencedColumnName="idArticle")
     * @var mixed
     */
    private $idArticle;

    /**
     * @ORM\Id
     * @ORM\Column(name="idSupplierOrder",type="integer")
     * @var mixed
     */
    private $idSupplierOrder;

    /**
     * @ORM\Column(name="unitCost",type="float")
     * @var mixed
     */
    private $unitCost;

    /**
     * @ORM\Column(name="dateReception",type="datetime")
     * @var mixed
     */
    private $dateReception;

    /**
     * @ORM\Column(type="float")
     * @var mixed
     */
    private $quantity;

  
    
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
    
    /**
     * getIdSupplierOrder
     *
     * @return int
     */
    public function getIdSupplierOrder(): ?int
    {
        return $this->idSupplierOrder;
    }
    
    /**
     * setIdSupplierOrder
     *
     * @param  int $idSupplierOrder
     * @return self
     */
    public function setIdSupplierOrder(int $idSupplierOrder): self
    {
        $this->idSupplierOrder = $idSupplierOrder;

        return $this;
    }
    
    /**
     * getUnitCost
     *
     * @return float
     */
    public function getUnitCost(): ?float
    {
        return $this->unitCost;
    }
    
    /**
     * setUnitCost
     *
     * @param  float $unitCost
     * @return self
     */
    public function setUnitCost(float $unitCost): self
    {
        $this->unitCost = $unitCost;

        return $this;
    }
    
    /**
     * getDateReception
     *
     * @return \DateTimeInterface
     */
    public function getDateReception(): ?\DateTimeInterface
    {
        return $this->dateReception;
    }
    
    /**
     * setDateReception
     *
     * @param  \DateTimeInterface $dateReception
     * @return self
     */
    public function setDateReception(\DateTimeInterface $dateReception): self
    {
        $this->dateReception = $dateReception;

        return $this;
    }
    
    /**
     * getQuantity
     *
     * @return float
     */
    public function getQuantity(): ?float
    {
        return $this->quantity;
    }
    
    /**
     * setQuantity
     *
     * @param  float $quantity
     * @return self
     */
    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
