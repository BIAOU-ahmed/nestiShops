<?php

namespace App\Entity;

use App\Repository\LogTokenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LogTokenRepository::class)
 */
class LogToken
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
    private $userAgent;

    /**
     * @ORM\ManyToOne(targetEntity=Token::class, inversedBy="logTokens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $token;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="logTokens")
     * @ORM\JoinColumn( referencedColumnName="idUsers")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    public function getToken(): ?Token
    {
        return $this->token;
    }

    public function setToken(?Token $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }
}
