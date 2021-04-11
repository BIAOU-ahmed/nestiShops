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
     */
    private $idArticle;

    /**
     * @ORM\Id
     * @ORM\Column(name="idSupplierOrder",type="integer")
     */
    private $idSupplierOrder;

    /**
     * @ORM\Column(name="unitCost",type="float")
     */
    private $unitCost;

    /**
     * @ORM\Column(name="dateReception",type="datetime")
     */
    private $dateReception;

    /**
     * @ORM\Column(type="float")
     */
    private $quantity;

  

    public function getIdArticle(): ?Article
    {
        return $this->idArticle;
    }

    public function setIdArticle(?Article $idArticle): self
    {
        $this->idArticle = $idArticle;

        return $this;
    }

    public function getIdSupplierOrder(): ?int
    {
        return $this->idSupplierOrder;
    }

    public function setIdSupplierOrder(int $idSupplierOrder): self
    {
        $this->idSupplierOrder = $idSupplierOrder;

        return $this;
    }

    public function getUnitCost(): ?float
    {
        return $this->unitCost;
    }

    public function setUnitCost(float $unitCost): self
    {
        $this->unitCost = $unitCost;

        return $this;
    }

    public function getDateReception(): ?\DateTimeInterface
    {
        return $this->dateReception;
    }

    public function setDateReception(\DateTimeInterface $dateReception): self
    {
        $this->dateReception = $dateReception;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
