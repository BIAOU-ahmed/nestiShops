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
     */
    private $idOrders;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="orderLines")
     * @ORM\JoinColumn(name="idArticle",nullable=false, referencedColumnName="idArticle")
     */
    private $idArticle;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function getIdOrders(): ?Orders
    {
        return $this->idOrders;
    }

    public function setIdOrders(?Orders $idOrders): self
    {
        $this->idOrders = $idOrders;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
