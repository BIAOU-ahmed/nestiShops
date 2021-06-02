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
     *
     */
    private $idUsers;

    /**
     * @Assert\NotBlank(
     *     message="Ce champ est obligatoire"
     * )
     * @ORM\Column(name="lastName",type="string", length=255)
     */
    private $lastName;

    /**
     * @Assert\NotBlank(
     *     message="Ce champ est obligatoire"
     * )
     * @ORM\Column(name="firstName",type="string", length=255)
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
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @Assert\NotCompromisedPassword
     * @RollerworksPassword\PasswordStrength(minLength=8, minStrength=4, message="mot de passe trop faible")
     * @ORM\Column(name="passwordHash", type="string", length=255)
     */ 
    private $password;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $flag = "w";

    /**
     * @ORM\Column(name="dateCreation",type="datetime")
     */
    private $dateCreation ;

    /**
     * @Assert\NotBlank(
     *     message="Ce champ est obligatoire"
     * )
     * @ORM\Column(name="login",type="string", length=65)
     */
    private $username;

    /**
     * @Assert\NotBlank(
     *     message="Ce champ est obligatoire"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $address1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
     */
    private $zipCode;


    /**
     * @ORM\OneToOne(targetEntity=Moderator::class, mappedBy="idModerator", cascade={"persist", "remove"})
     */
    private $moderator;

    /**
     * @ORM\OneToOne(targetEntity=Chef::class, mappedBy="idChef", cascade={"persist", "remove"})
     */
    private $chef;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="users",cascade={"persist"})
     * @ORM\JoinColumn(name="idCity",referencedColumnName="idCity")
     */
    private $idCity;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="idUsers", orphanRemoval=true)
     */
    private $orders;

    /**
     * @ORM\OneToOne(targetEntity=Administrator::class, mappedBy="idAdministrator", cascade={"persist", "remove"})
     */
    private $administrator;

    /**
     * @ORM\OneToMany(targetEntity=Grades::class, mappedBy="idUsers", orphanRemoval=true)
     */
    private $grades;

    /**
     * @ORM\OneToMany(targetEntity=ConnectionLog::class, mappedBy="idUsers", orphanRemoval=true)
     */
    private $connectionLogs;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="idUsers", orphanRemoval=true)
     *
     * @Groups({"show_user"})
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=LogToken::class, mappedBy="user")
     */
    private $logTokens;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->grades = new ArrayCollection();
        $this->connectionLogs = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->dateCreation = new DateTime();
        $this->logTokens = new ArrayCollection();
    }

    public function getIdUsers(): ?int
    {
        return $this->idUsers;
    }

    public function setIdUsers(int $idUsers): self
    {
        $this->idUsers = $idUsers;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName($lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1($address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setZipCode($zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getModerator(): ?Moderator
    {
        return $this->moderator;
    }

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

    public function getChef(): ?Chef
    {
        return $this->chef;
    }

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

    public function getIdCity(): ?City
    {
        return $this->idCity;
    }

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

    public function addOrder(Orders $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setIdUsers($this);
        }

        return $this;
    }

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

    public function getAdministrator(): ?Administrator
    {
        return $this->administrator;
    }

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

    public function addGrade(Grades $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades[] = $grade;
            $grade->setIdUsers($this);
        }

        return $this;
    }

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

    public function addConnectionLog(ConnectionLog $connectionLog): self
    {
        if (!$this->connectionLogs->contains($connectionLog)) {
            $this->connectionLogs[] = $connectionLog;
            $connectionLog->setIdUsers($this);
        }

        return $this;
    }

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

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIdUsers($this);
        }

        return $this;
    }

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
    }


    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

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

    public function addLogToken(LogToken $logToken): self
    {
        if (!$this->logTokens->contains($logToken)) {
            $this->logTokens[] = $logToken;
            $logToken->setUser($this);
        }

        return $this;
    }

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
