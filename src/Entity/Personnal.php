<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonnalRepository")
 */
class Personnal implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="personnals")
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Specialization", inversedBy="personnals")
     */
    private $specialization;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HospitalNode", inversedBy="workers")
     */
    private $hospitalNode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HospitalNode", inversedBy="personnals")
     * @ORM\JoinColumn(nullable=true)
     */
    private $assignment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Acts", mappedBy="author")
     */
    private $acts;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;
    
    public function __construct()
    {
        $this->specialization = new ArrayCollection();
        $this->acts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|Specialization[]
     */
    public function getSpecialization(): Collection
    {
        return $this->specialization;
    }

    public function addSpecialization(Specialization $specialization): self
    {
        if (!$this->specialization->contains($specialization)) {
            $this->specialization[] = $specialization;
        }

        return $this;
    }

    public function removeSpecialization(Specialization $specialization): self
    {
        if ($this->specialization->contains($specialization)) {
            $this->specialization->removeElement($specialization);
        }

        return $this;
    }

    public function getHospitalNode(): ?HospitalNode
    {
        return $this->hospitalNode;
    }

    public function setHospitalNode(?HospitalNode $hospitalNode): self
    {
        $this->hospitalNode = $hospitalNode;

        return $this;
    }

    public function getAssignment(): ?HospitalNode
    {
        return $this->assignment;
    }

    public function setAssignment(?HospitalNode $assignment): self
    {
        $this->assignment = $assignment;

        return $this;
    }

    /**
     * @return Collection|Acts[]
     */
    public function getActs(): Collection
    {
        return $this->acts;
    }

    public function addAct(Acts $act): self
    {
        if (!$this->acts->contains($act)) {
            $this->acts[] = $act;
            $act->setAuthor($this);
        }

        return $this;
    }

    public function removeAct(Acts $act): self
    {
        if ($this->acts->contains($act)) {
            $this->acts->removeElement($act);
            // set the owning side to null (unless already changed)
            if ($act->getAuthor() === $this) {
                $act->setAuthor(null);
            }
        }

        return $this;
    }
    public function getPassword(): ?string
    {
        return $this->password;
    }
    
    public function setPassword(string $password): self {
        $this->password = $password;
        
        return $this;
    }

    public function eraseCredentials()
    {}

    public function getSalt()
    {}

    public function getRoles()
    {
        return ['ROLE_MEMBER'];
    }

    public function getUsername(): ?string
    {
        return $this->getEmail();
    }

}
