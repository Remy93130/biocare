<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoryRepository")
 */
class History
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\DMP", inversedBy="histories")
     */
    private $DMP;

    /**
     * @ORM\Column(type="date")
     */
    private $dateE;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateS;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reason;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HospitalNode", inversedBy="histories")
     */
    private $hospitalNode;

    public function __construct()
    {
        $this->DMP = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|DMP[]
     */
    public function getDMP(): Collection
    {
        return $this->DMP;
    }

    public function addDMP(DMP $dMP): self
    {
        if (!$this->DMP->contains($dMP)) {
            $this->DMP[] = $dMP;
        }

        return $this;
    }

    public function removeDMP(DMP $dMP): self
    {
        if ($this->DMP->contains($dMP)) {
            $this->DMP->removeElement($dMP);
        }

        return $this;
    }

    public function getDateE(): ?\DateTimeInterface
    {
        return $this->dateE;
    }

    public function setDateE(\DateTimeInterface $dateE): self
    {
        $this->dateE = $dateE;

        return $this;
    }

    public function getDateS(): ?\DateTimeInterface
    {
        return $this->dateS;
    }

    public function setDateS(?\DateTimeInterface $dateS): self
    {
        $this->dateS = $dateS;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

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
}
