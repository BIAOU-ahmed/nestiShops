<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idOrders",type="integer")
     * @var mixed
     */
    private $idOrders;

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
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="orders")
     * @ORM\JoinColumn(name="idUsers",nullable=false, referencedColumnName="idUsers")
     * @var mixed
     */
    private $idUsers;

    /**
     * @ORM\OneToMany(targetEntity=OrderLine::class, mappedBy="idOrders", orphanRemoval=true)
     * @var mixed
     */
    private $orderLines;

    /**
     * @ORM\Column(type="text")
     * @var mixed
     */
    private $adress;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->orderLines = new ArrayCollection();
    }
    
    /**
     * getIdOrders
     *
     * @return int
     */
    public function getIdOrders(): ?int
    {
        return $this->idOrders;
    }
    
    /**
     * setIdOrders
     *
     * @param  int $idOrders
     * @return self
     */
    public function setIdOrders(int $idOrders): self
    {
        $this->idOrders = $idOrders;

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
     * getIdUsers
     *
     * @return Users
     */
    public function getIdUsers(): ?Users
    {
        return $this->idUsers;
    }
    
    /**
     * setIdUsers
     *
     * @param  Users $idUsers
     * @return self
     */
    public function setIdUsers(?Users $idUsers): self
    {
        $this->idUsers = $idUsers;

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
            $orderLine->setIdOrders($this);
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
            if ($orderLine->getIdOrders() === $this) {
                $orderLine->setIdOrders(null);
            }
        }

        return $this;
    }
    
    /**
     * getAdress
     *
     * @return string
     */
    public function getAdress(): ?string
    {
        return $this->adress;
    }
    
    /**
     * setAdress
     *
     * @param  string $adress
     * @return self
     */
    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }
    
    
        
    /**
     * getPrice
     *
     * @return float
     */
    public function getPrice(): float
    {
        $orderLines = $this->getOrderLines();
        $price = 0;
        $dateMax = (String) strtotime($this->getDateCreation()->format('Y-m-d'));
        foreach ($orderLines as $line) {
            $price += $line->getIdArticle()->getLastPriceAt($dateMax) * $line->getQuantity();
        }
        return $price;
    }


}
