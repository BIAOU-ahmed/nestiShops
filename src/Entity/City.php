<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
class City
{
   
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idCity",type="integer")
     * @var mixed
     */
    private $idCity;

    /**
     * @ORM\Column(type="string", length=255)
     * @var mixed
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Users::class, mappedBy="idCity")
     * @var mixed
     */
    private $users;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

  
    
    /**
     * getIdCity
     *
     * @return int
     */
    public function getIdCity(): ?int
    {
        return $this->idCity;
    }
    
    /**
     * setIdCity
     *
     * @param  int $idCity
     * @return self
     */
    public function setIdCity(int $idCity): self
    {
        $this->idCity = $idCity;

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
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }
    
    /**
     * addUser
     *
     * @param  Users $user
     * @return self
     */
    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setIdCity($this);
        }

        return $this;
    }
    
    /**
     * removeUser
     *
     * @param  Users $user
     * @return self
     */
    public function removeUser(Users $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getIdCity() === $this) {
                $user->setIdCity(null);
            }
        }

        return $this;
    }
    
    /**
     * __toString
     *
     * @return String
     */
    public function __toString():String
    {
        return $this->getName();
    }
}
