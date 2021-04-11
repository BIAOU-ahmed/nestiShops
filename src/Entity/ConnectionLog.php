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
     */
    private $idConnectionLog;

    /**
     * @ORM\Column(name="dateConnection",type="datetime")
     */
    private $dateConnection;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="connectionLogs")
     * @ORM\JoinColumn(name="idUsers",nullable=false, referencedColumnName="idUsers")
     */
    private $idUsers;

  

    public function getIdConnectionLog(): ?int
    {
        return $this->idConnectionLog;
    }

    public function setIdConnectionLog(int $idConnectionLog): self
    {
        $this->idConnectionLog = $idConnectionLog;

        return $this;
    }

    public function getDateConnection(): ?\DateTimeInterface
    {
        return $this->dateConnection;
    }

    public function setDateConnection(\DateTimeInterface $dateConnection): self
    {
        $this->dateConnection = $dateConnection;

        return $this;
    }

    public function getIdUsers(): ?Users
    {
        return $this->idUsers;
    }

    public function setIdUsers(?Users $idUsers): self
    {
        $this->idUsers = $idUsers;

        return $this;
    }
}
