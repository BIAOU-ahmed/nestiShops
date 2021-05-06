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
     */
    private $idCity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Users::class, mappedBy="idCity")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

  

    public function getIdCity(): ?int
    {
        return $this->idCity;
    }

    public function setIdCity(int $idCity): self
    {
        $this->idCity = $idCity;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

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

    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setIdCity($this);
        }

        return $this;
    }

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

    public function __toString()
    {
        return $this->getName();
    }
}
