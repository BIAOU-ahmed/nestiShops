<?php

namespace App\Entity;

use App\Repository\OrderLineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="orderline")
 * @ORM\Entity(repositoryClass=OrderLineRepository::class)
 */
class OrderLine
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Orders::class, inversedBy="orderLines")
     * @ORM\JoinColumn(name="idOrders",nullable=false, referencedColumnName="idOrders")
     * @var mixed
     */
    private $idOrders;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="orderLines")
     * @ORM\JoinColumn(name="idArticle",nullable=false, referencedColumnName="idArticle")
     * @var mixed
     */
    private $idArticle;

    /**
     * @ORM\Column(type="integer")
     * @var mixed
     */
    private $quantity;
    
    /**
     * getIdOrders
     *
     * @return Orders
     */
    public function getIdOrders(): ?Orders
    {
        return $this->idOrders;
    }
    
    /**
     * setIdOrders
     *
     * @param  Orders $idOrders
     * @return self
     */
    public function setIdOrders(?Orders $idOrders): self
    {
        $this->idOrders = $idOrders;

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
    
    /**
     * getQuantity
     *
     * @return int
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }
    
    /**
     * setQuantity
     *
     * @param  int $quantity
     * @return self
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
