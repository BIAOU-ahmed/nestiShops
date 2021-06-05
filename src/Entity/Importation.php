<?php

namespace App\Entity;

use App\Repository\ImportationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImportationRepository::class)
 */
class Importation
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Administrator::class, inversedBy="importations")
     * @ORM\JoinColumn(name="idAdministrator",nullable=false, referencedColumnName="idAdministrator")
     * @var mixed
     */
    private $idAdministrator;

    /**
     * @ORM\Id
     * @ORM\JoinColumn(name="idArticle",nullable=false, referencedColumnName="idArticle")
     * @var mixed
     */
    private $idArticle;

    /**
     * @ORM\Id
     * @ORM\JoinColumn(name="idSupplierOrder",nullable=false, referencedColumnName="idSupplierOrder")
     * @var mixed
     */
    private $idSupplierOrder;

    /**
     * @ORM\Column(name="importationDate",type="datetime")
     * @var mixed
     */
    private $importationDate;


    /**
     * @ORM\ManyToOne(targetEntity="Lot")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="idArticle", referencedColumnName="idArticle"),
     *     @ORM\JoinColumn(name="idSupplierOrder", referencedColumnName="idSupplierOrder")
     * })
     * @var mixed
     **/
    protected $lot;
    
    /**
     * getIdAdministrator
     *
     * @return Administrator
     */
    public function getIdAdministrator(): ?Administrator
    {
        return $this->idAdministrator;
    }
    
    /**
     * setIdAdministrator
     *
     * @param  Administrator $idAdministrator
     * @return self
     */
    public function setIdAdministrator(?Administrator $idAdministrator): self
    {
        $this->idAdministrator = $idAdministrator;

        return $this;
    }
    
    /**
     * getIdArticle
     *
     * @return Lot
     */
    public function getIdArticle(): ?Lot
    {
        return $this->idArticle;
    }
    
    /**
     * setIdArticle
     *
     * @param  Lot $idArticle
     * @return self
     */
    public function setIdArticle(Lot $idArticle): self
    {
        $this->idArticle = $idArticle;

        return $this;
    }
    
    /**
     * getIdSupplierOrder
     *
     * @return Lot
     */
    public function getIdSupplierOrder(): ?Lot
    {
        return $this->idSupplierOrder;
    }
    
    /**
     * setIdSupplierOrder
     *
     * @param  Lot $idSupplierOrder
     * @return self
     */
    public function setIdSupplierOrder(Lot $idSupplierOrder): self
    {
        $this->idSupplierOrder = $idSupplierOrder;

        return $this;
    }
    
    /**
     * getImportationDate
     *
     * @return \DateTimeInterface
     */
    public function getImportationDate(): ?\DateTimeInterface
    {
        return $this->importationDate;
    }
    
    /**
     * setImportationDate
     *
     * @param  \DateTimeInterface $importationDate
     * @return self
     */
    public function setImportationDate(\DateTimeInterface $importationDate): self
    {
        $this->importationDate = $importationDate;

        return $this;
    }
}
