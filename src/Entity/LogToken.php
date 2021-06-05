<?php

namespace App\Entity;

use App\Repository\LogTokenRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=LogTokenRepository::class)
 */
class LogToken
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var mixed
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var mixed
     */
    private $userAgent;

    /**
     * @ORM\ManyToOne(targetEntity=Token::class, inversedBy="logTokens")
     * @ORM\JoinColumn(nullable=false)
     * @var mixed
     */
    private $token;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="logTokens")
     * @ORM\JoinColumn( referencedColumnName="idUsers")
     * @var mixed
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     * @var mixed
     */
    private $createdAt;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->createdAt = new DateTime();
    }
    
    /**
     * getId
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * getUserAgent
     *
     * @return string
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }
    
    /**
     * setUserAgent
     *
     * @param  string $userAgent
     * @return self
     */
    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }
    
    /**
     * getToken
     *
     * @return Token
     */
    public function getToken(): ?Token
    {
        return $this->token;
    }
    
    /**
     * setToken
     *
     * @param  Token $token
     * @return self
     */
    public function setToken(?Token $token): self
    {
        $this->token = $token;

        return $this;
    }
    
    /**
     * getUser
     *
     * @return Users
     */
    public function getUser(): ?Users
    {
        return $this->user;
    }
    
    /**
     * setUser
     *
     * @param  UserInterface|null $user
     * @return self
     */
    public function setUser(?UserInterface $user): self
    {
        $this->user = $user;

        return $this;
    }
    
    /**
     * getCreatedAt
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
    
    /**
     * setCreatedAt
     *
     * @param  \DateTimeInterface $createdAt
     * @return self
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
