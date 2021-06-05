<?php

namespace App\Entity;

use App\Repository\ConnectionLogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="connectionlog")
 * @ORM\Entity(repositoryClass=ConnectionLogRepository::class)
 */
class ConnectionLog
{
 
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idConnectionLog",type="integer")
     * @var mixed
     */
    private $idConnectionLog;

    /**
     * @ORM\Column(name="dateConnection",type="datetime")
     * @var mixed
     */
    private $dateConnection;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="connectionLogs")
     * @ORM\JoinColumn(name="idUsers",nullable=false, referencedColumnName="idUsers")
     * @var mixed
     */
    private $idUsers;

  
    
    /**
     * getIdConnectionLog
     *
     * @return int
     */
    public function getIdConnectionLog(): ?int
    {
        return $this->idConnectionLog;
    }
    
    /**
     * setIdConnectionLog
     *
     * @param  int $idConnectionLog
     * @return self
     */
    public function setIdConnectionLog(int $idConnectionLog): self
    {
        $this->idConnectionLog = $idConnectionLog;

        return $this;
    }
    
    /**
     * getDateConnection
     *
     * @return \DateTimeInterface
     */
    public function getDateConnection(): ?\DateTimeInterface
    {
        return $this->dateConnection;
    }
    
    /**
     * setDateConnection
     *
     * @param  \DateTimeInterface $dateConnection
     * @return self
     */
    public function setDateConnection(\DateTimeInterface $dateConnection): self
    {
        $this->dateConnection = $dateConnection;

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
}
