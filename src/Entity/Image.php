<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idImage",type="integer")
     * @var mixed
     */
    private $idImage;

    /**
     * @ORM\Column(name="dateCreation",type="datetime")
     * @var mixed
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255)
     * @var mixed
     */
    private $name;

    /**
     * @ORM\Column(name="fileExtension",type="string", length=255)
     * @var mixed
     */
    private $fileExtension;

  
    
    /**
     * getIdImage
     *
     * @return int
     */
    public function getIdImage(): ?int
    {
        return $this->idImage;
    }
    
    /**
     * setIdImage
     *
     * @param  int $idImage
     * @return self
     */
    public function setIdImage(int $idImage): self
    {
        $this->idImage = $idImage;

        return $this;
    }
    
    /**
     * getDateCreation
     *
     * @return \DateTimeInterface
     */
    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }
    
    /**
     * setDateCreation
     *
     * @param  \DateTimeInterface $dateCreation
     * @return self
     */
    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

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
     * getFileExtension
     *
     * @return string
     */
    public function getFileExtension(): ?string
    {
        return $this->fileExtension;
    }
    
    /**
     * setFileExtension
     *
     * @param  string $fileExtension
     * @return self
     */
    public function setFileExtension(string $fileExtension): self
    {
        $this->fileExtension = $fileExtension;

        return $this;
    }
}
