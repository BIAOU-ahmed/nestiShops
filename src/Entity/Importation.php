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
     */
    private $idAdministrator;

    /**
     * @ORM\Id
     * @ORM\JoinColumn(name="idArticle",nullable=false, referencedColumnName="idArticle")
     */
    private $idArticle;

    /**
     * @ORM\Id
     * @ORM\JoinColumn(name="idSupplierOrder",nullable=false, referencedColumnName="idSupplierOrder")
     */
    private $idSupplierOrder;

    /**
     * @ORM\Column(name="importationDate",type="datetime")
     */
    private $importationDate;


    /**
     * @ORM\ManyToOne(targetEntity="Lot")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="idArticle", referencedColumnName="idArticle"),
     *     @ORM\JoinColumn(name="idSupplierOrder", referencedColumnName="idSupplierOrder")
     * })
     **/
    protected $lot;

    public function getIdAdministrator(): ?Administrator
    {
        return $this->idAdministrator;
    }

    public function setIdAdministrator(?Administrator $idAdministrator): self
    {
        $this->idAdministrator = $idAdministrator;

        return $this;
    }

    public function getIdArticle(): ?Lot
    {
        return $this->idArticle;
    }

    public function setIdArticle(Lot $idArticle): self
    {
        $this->idArticle = $idArticle;

        return $this;
    }

    public function getIdSupplierOrder(): ?Lot
    {
        return $this->idSupplierOrder;
    }

    public function setIdSupplierOrder(Lot $idSupplierOrder): self
    {
        $this->idSupplierOrder = $idSupplierOrder;

        return $this;
    }

    public function getImportationDate(): ?\DateTimeInterface
    {
        return $this->importationDate;
    }

    public function setImportationDate(\DateTimeInterface $importationDate): self
    {
        $this->importationDate = $importationDate;

        return $this;
    }
}
