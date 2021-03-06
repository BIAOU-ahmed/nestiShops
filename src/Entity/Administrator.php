<?php

namespace App\Entity;

use App\Repository\AdministratorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdministratorRepository::class)
 */
class Administrator
{

    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity=Users::class, inversedBy="administrator", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAdministrator", referencedColumnName="idUsers")
     * })
     * @var mixed
     */    
  
    private $idAdministrator;

    /**
     * @ORM\OneToMany(targetEntity=Importation::class, mappedBy="idAdministrator", orphanRemoval=true)
     * @var mixed
     */
    private $importations;

    public function __construct()
    {
        $this->importations = new ArrayCollection();
    }


    
    /**
     * getIdAdministrator
     *
     * @return Users
     */
    public function getIdAdministrator(): ?Users
    {
        return $this->idAdministrator;
    }
    
    /**
     * setIdAdministrator
     *
     * @param  Users $idAdministrator
     * @return self
     */
    public function setIdAdministrator(Users $idAdministrator): self
    {
        $this->idAdministrator = $idAdministrator;

        return $this;
    }

    /**
     * @return Collection|Importation[]
     */
    public function getImportations(): Collection
    {
        return $this->importations;
    }
    
    /**
     * addImportation
     *
     * @param  Importation $importation
     * @return self
     */
    public function addImportation(Importation $importation): self
    {
        if (!$this->importations->contains($importation)) {
            $this->importations[] = $importation;
            $importation->setIdAdministrator($this);
        }

        return $this;
    }
    
    /**
     * removeImportation
     *
     * @param  Importation $importation
     * @return self
     */
    public function removeImportation(Importation $importation): self
    {
        if ($this->importations->removeElement($importation)) {
            // set the owning side to null (unless already changed)
            if ($importation->getIdAdministrator() === $this) {
                $importation->setIdAdministrator(null);
            }
        }

        return $this;
    }
}
