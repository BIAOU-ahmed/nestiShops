<?php

namespace App\Entity;

use App\Repository\TokenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TokenRepository::class)
 */
class Token
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=LogToken::class, mappedBy="token")
     */
    private $logTokens;

    public function __construct()
    {
        $this->logTokens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|LogToken[]
     */
    public function getLogTokens(): Collection
    {
        return $this->logTokens;
    }

    public function addLogToken(LogToken $logToken): self
    {
        if (!$this->logTokens->contains($logToken)) {
            $this->logTokens[] = $logToken;
            $logToken->setToken($this);
        }

        return $this;
    }

    public function removeLogToken(LogToken $logToken): self
    {
        if ($this->logTokens->removeElement($logToken)) {
            // set the owning side to null (unless already changed)
            if ($logToken->getToken() === $this) {
                $logToken->setToken(null);
            }
        }

        return $this;
    }
}
