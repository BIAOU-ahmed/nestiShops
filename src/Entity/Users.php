<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsersRepository;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Rollerworks\Component\PasswordStrength\Validator\Constraints as RollerworksPassword;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity("email", message="Email indisponible.")
 * @UniqueEntity("username", message="Nom d'utilisateur indisponible.")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="idUsers",type="integer")
     * @var mixed
     */
    private $idUsers;

    /**
     * @Assert\NotBlank(
     *     message="Ce champ est obligatoire"
     * )
     * @ORM\Column(name="lastName",type="string", length=255)
     * @var mixed
     */
    private $lastName;

    /**
     * @Assert\NotBlank(
     *     message="Ce champ est obligatoire"
     * )
     * @ORM\Column(name="firstName",type="string", length=255)
     * @var mixed
     */
    private $firstName;

    /**
     * @Assert\NotBlank(
     *     message="Ce champ est obligatoire"
     * )
     * @Assert\Email(
     *     message = "L'email '{{ value }}' est invalid."
     * )
     * @ORM\Column(type="string", length=255)
     * @var mixed
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @Assert\NotCompromisedPassword
     * @RollerworksPassword\PasswordStrength(minLength=8, minStrength=4, message="mot de passe trop faible")
     * @ORM\Column(name="passwordHash", type="string", length=255)
     * @var mixed
     */ 
    private $password;

    /**
     * @ORM\Column(type="string", length=1)
     * @var mixed
     */
    private $flag = "w";

    /**
     * @ORM\Column(name="dateCreation",type="datetime")
     * @var mixed
     */
    private $dateCreation ;

    /**
     * @Assert\NotBlank(
     *     message="Ce champ est obligatoire"
     * )
     * @ORM\Column(name="login",type="string", length=65)
     * @var mixed
     */
    private $username;

    /**
     * @Assert\NotBlank(
     *     message="Ce champ est obligatoire"
     * )
     * @ORM\Column(type="string", length=255)
     * @var mixed
     */
    private $address1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var mixed
     */
    private $address2;

    /**
     * @Assert\NotBlank(
     *     message="Ce champ est obligatoire"
     * )
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="Le code postal ne doit contenir que des chiffres"
     * )
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      exactMessage = "Le code postal doit avoir exactement {{ limit }} chiffres",
     * )
     * @ORM\Column(name="zipCode",type="string")
     * @var mixed
     */
    private $zipCode;


    /**
     * @ORM\OneToOne(targetEntity=Moderator::class, mappedBy="idModerator", cascade={"persist", "remove"})
     * @var mixed
     */
    private $moderator;

    /**
     * @ORM\OneToOne(targetEntity=Chef::class, mappedBy="idChef", cascade={"persist", "remove"})
     * @var mixed
     */
    private $chef;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="users",cascade={"persist"})
     * @ORM\JoinColumn(name="idCity",referencedColumnName="idCity")
     * @var mixed
     */
    private $idCity;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="idUsers", orphanRemoval=true)
     * @var mixed
     */
    private $orders;

    /**
     * @ORM\OneToOne(targetEntity=Administrator::class, mappedBy="idAdministrator", cascade={"persist", "remove"})
     * @var mixed
     */
    private $administrator;

    /**
     * @ORM\OneToMany(targetEntity=Grades::class, mappedBy="idUsers", orphanRemoval=true)
     * @var mixed
     */
    private $grades;

    /**
     * @ORM\OneToMany(targetEntity=ConnectionLog::class, mappedBy="idUsers", orphanRemoval=true)
     * @var mixed
     */
    private $connectionLogs;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="idUsers", orphanRemoval=true)
     *
     * @Groups({"show_user"})
     * @var mixed
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=LogToken::class, mappedBy="user")
     * @var mixed
     */
    private $logTokens;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->grades = new ArrayCollection();
        $this->connectionLogs = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->dateCreation = new DateTime();
        $this->logTokens = new ArrayCollection();
    }
    
    /**
     * getIdUsers
     *
     * @return int
     */
    public function getIdUsers(): ?int
    {
        return $this->idUsers;
    }
    
    /**
     * setIdUsers
     *
     * @param  int $idUsers
     * @return self
     */
    public function setIdUsers(int $idUsers): self
    {
        $this->idUsers = $idUsers;

        return $this;
    }
    
    /**
     * getLastName
     *
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }
    
    /**
     * setLastName
     *
     * @param  mixed $lastName
     * @return self
     */
    public function setLastName($lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }
    
    /**
     * getFirstName
     *
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }
    
    /**
     * setFirstName
     *
     * @param  mixed $firstName
     * @return self
     */
    public function setFirstName($firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }
    
    /**
     * getEmail
     *
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    /**
     * setEmail
     *
     * @param  mixed $email
     * @return self
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }
    
    /**
     * getPassword
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }
    
    /**
     * setPassword
     *
     * @param  string|null $password
     * @return self
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }
    
    /**
     * getFlag
     *
     * @return string
     */
    public function getFlag(): ?string
    {
        return $this->flag;
    }
    
    /**
     * setFlag
     *
     * @param  string $flag
     * @return self
     */
    public function setFlag(string $flag): self
    {
        $this->flag = $flag;

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
     * getAddress1
     *
     * @return string
     */
    public function getAddress1(): ?string
    {
        return $this->address1;
    }
    
    /**
     * setAddress1
     *
     * @param  string|null $address1
     * @return self
     */
    public function setAddress1($address1): self
    {
        $this->address1 = $address1;

        return $this;
    }
    
    /**
     * getAddress2
     *
     * @return string
     */
    public function getAddress2(): ?string
    {
        return $this->address2;
    }
    
    /**
     * setAddress2
     *
     * @param  string $address2
     * @return self
     */
    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }
    
    /**
     * getZipCode
     *
     * @return String
     */
    public function getZipCode():String
    {
        return $this->zipCode;
    }
    
    /**
     * setZipCode
     *
     * @param  String|null $zipCode
     * @return self
     */
    public function setZipCode($zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }
    
    /**
     * getModerator
     *
     * @return Moderator
     */
    public function getModerator(): ?Moderator
    {
        return $this->moderator;
    }
    
    /**
     * setModerator
     *
     * @param  Moderator $moderator
     * @return self
     */
    public function setModerator(?Moderator $moderator): self
    {
        // unset the owning side of the relation if necessary
        if ($moderator === null && $this->moderator !== null) {
            $this->moderator->setIdModerator(null);
        }

        // set the owning side of the relation if necessary
        if ($moderator !== null && $moderator->getIdModerator() !== $this) {
            $moderator->setIdModerator($this);
        }

        $this->moderator = $moderator;

        return $this;
    }
    
    /**
     * getChef
     *
     * @return Chef
     */
    public function getChef(): ?Chef
    {
        return $this->chef;
    }
    
    /**
     * setChef
     *
     * @param  Chef $chef
     * @return self
     */
    public function setChef(?Chef $chef): self
    {
        // unset the owning side of the relation if necessary
        if ($chef === null && $this->chef !== null) {
            $this->chef->setIdChef(null);
        }

        // set the owning side of the relation if necessary
        if ($chef !== null && $chef->getIdChef() !== $this) {
            $chef->setIdChef($this);
        }

        $this->chef = $chef;

        return $this;
    }
    
    /**
     * getIdCity
     *
     * @return City
     */
    public function getIdCity(): ?City
    {
        return $this->idCity;
    }
    
    /**
     * setIdCity
     *
     * @param  City $idCity
     * @return self
     */
    public function setIdCity(?City $idCity): self
    {
        $this->idCity = $idCity;

        return $this;
    }

    /**
     * @return Collection|Orders[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }
    
    /**
     * addOrder
     *
     * @param  Orders $order
     * @return self
     */
    public function addOrder(Orders $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setIdUsers($this);
        }

        return $this;
    }
    
    /**
     * removeOrder
     *
     * @param  Orders $order
     * @return self
     */
    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getIdUsers() === $this) {
                $order->setIdUsers(null);
            }
        }

        return $this;
    }
    
    /**
     * getAdministrator
     *
     * @return Administrator
     */
    public function getAdministrator(): ?Administrator
    {
        return $this->administrator;
    }
    
    /**
     * setAdministrator
     *
     * @param  Administrator $administrator
     * @return self
     */
    public function setAdministrator(Administrator $administrator): self
    {
        // set the owning side of the relation if necessary
        if ($administrator->getIdAdministrator() !== $this) {
            $administrator->setIdAdministrator($this);
        }

        $this->administrator = $administrator;

        return $this;
    }

    /**
     * @return Collection|Grades[]
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }
    
    /**
     * addGrade
     *
     * @param  Grades $grade
     * @return self
     */
    public function addGrade(Grades $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades[] = $grade;
            $grade->setIdUsers($this);
        }

        return $this;
    }
    
    /**
     * removeGrade
     *
     * @param  Grades $grade
     * @return self
     */
    public function removeGrade(Grades $grade): self
    {
        if ($this->grades->removeElement($grade)) {
            // set the owning side to null (unless already changed)
            if ($grade->getIdUsers() === $this) {
                $grade->setIdUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ConnectionLog[]
     */
    public function getConnectionLogs(): Collection
    {
        return $this->connectionLogs;
    }
    
    /**
     * addConnectionLog
     *
     * @param  ConnectionLog $connectionLog
     * @return self
     */
    public function addConnectionLog(ConnectionLog $connectionLog): self
    {
        if (!$this->connectionLogs->contains($connectionLog)) {
            $this->connectionLogs[] = $connectionLog;
            $connectionLog->setIdUsers($this);
        }

        return $this;
    }
    
    /**
     * removeConnectionLog
     *
     * @param  ConnectionLog $connectionLog
     * @return self
     */
    public function removeConnectionLog(ConnectionLog $connectionLog): self
    {
        if ($this->connectionLogs->removeElement($connectionLog)) {
            // set the owning side to null (unless already changed)
            if ($connectionLog->getIdUsers() === $this) {
                $connectionLog->setIdUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }
    
    /**
     * addComment
     *
     * @param  Comment $comment
     * @return self
     */
    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIdUsers($this);
        }

        return $this;
    }
    
    /**
     * removeComment
     *
     * @param  Comment $comment
     * @return self
     */
    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getIdUsers() === $this) {
                $comment->setIdUsers(null);
            }
        }

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "auto" algorithm in security.yaml
        return '';
    }


        
    /**
     * getRoles
     * @see UserInterface
     * @return array<String>
     */
    public function getRoles(): array
    {
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

      
    /**
     * eraseCredentials
     * @see UserInterface
     * @return void
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    
    /**
     * getUsername
     *
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }
    
    /**
     * setUsername
     *
     * @param  string $username
     * @return self
     */
    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection|LogToken[]
     */
    public function getLogTokens(): Collection
    {
        return $this->logTokens;
    }
    
    /**
     * addLogToken
     *
     * @param  LogToken $logToken
     * @return self
     */
    public function addLogToken(LogToken $logToken): self
    {
        if (!$this->logTokens->contains($logToken)) {
            $this->logTokens[] = $logToken;
            $logToken->setUser($this);
        }

        return $this;
    }
    
    /**
     * removeLogToken
     *
     * @param  LogToken $logToken
     * @return self
     */
    public function removeLogToken(LogToken $logToken): self
    {
        if ($this->logTokens->removeElement($logToken)) {
            // set the owning side to null (unless already changed)
            if ($logToken->getUser() === $this) {
                $logToken->setUser(null);
            }
        }

        return $this;
    }
}
