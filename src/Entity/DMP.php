<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DMPRepository")
 */
class DMP
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HospitalNode", inversedBy="dMPs")
     */
    private $nodeManaging;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $socialNumber;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $birthPlace;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\History", mappedBy="DMP")
     */
    private $histories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Acts", mappedBy="DMP")
     */
    private $acts;

    public function __construct()
    {
        $this->histories = new ArrayCollection();
        $this->acts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNodeManaging(): ?HospitalNode
    {
        return $this->nodeManaging;
    }

    public function setNodeManaging(?HospitalNode $nodeManaging): self
    {
        $this->nodeManaging = $nodeManaging;

        return $this;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSocialNumber(): ?string
    {
        return $this->socialNumber;
    }

    public function setSocialNumber(string $socialNumber): self
    {
        $this->socialNumber = $socialNumber;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getBirthPlace(): ?string
    {
        return $this->birthPlace;
    }

    public function setBirthPlace(?string $birthPlace): self
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|History[]
     */
    public function getHistories(): Collection
    {
        return $this->histories;
    }

    public function addHistory(History $history): self
    {
        if (!$this->histories->contains($history)) {
            $this->histories[] = $history;
            $history->addDMP($this);
        }

        return $this;
    }

    public function removeHistory(History $history): self
    {
        if ($this->histories->contains($history)) {
            $this->histories->removeElement($history);
            $history->removeDMP($this);
        }

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
            $act->setDMP($this);
        }

        return $this;
    }

    public function removeAct(Acts $act): self
    {
        if ($this->acts->contains($act)) {
            $this->acts->removeElement($act);
            // set the owning side to null (unless already changed)
            if ($act->getDMP() === $this) {
                $act->setDMP(null);
            }
        }

        return $this;
    }
    
    /**
     * Return format to display DMPs in other form
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->surname . " " . $this->name . " - " . $this->socialNumber;
    }
}
