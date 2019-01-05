<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HospitalNodeRepository")
 */
class HospitalNode
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Personnal", mappedBy="hospitalNode")
     */
    private $workers;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Personnal", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $responsible;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HospitalNode", inversedBy="hospitalNodes")
     */
    private $ancestorNode;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HospitalNode", mappedBy="ancestorNode")
     */
    private $hospitalNodes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeNode", inversedBy="hospitalNodes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeNode;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Personnal", mappedBy="assignment")
     */
    private $personnals;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DMP", mappedBy="nodeManaging")
     */
    private $dMPs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\History", mappedBy="hospitalNode")
     */
    private $histories;

    public function __construct()
    {
        $this->workers = new ArrayCollection();
        $this->hospitalNodes = new ArrayCollection();
        $this->personnals = new ArrayCollection();
        $this->dMPs = new ArrayCollection();
        $this->histories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Personnal[]
     */
    public function getWorkers(): Collection
    {
        return $this->workers;
    }

    public function addWorker(Personnal $worker): self
    {
        if (!$this->workers->contains($worker)) {
            $this->workers[] = $worker;
            $worker->setHospitalNode($this);
        }

        return $this;
    }

    public function removeWorker(Personnal $worker): self
    {
        if ($this->workers->contains($worker)) {
            $this->workers->removeElement($worker);
            // set the owning side to null (unless already changed)
            if ($worker->getHospitalNode() === $this) {
                $worker->setHospitalNode(null);
            }
        }

        return $this;
    }

    public function getResponsible(): ?Personnal
    {
        return $this->responsible;
    }

    public function setResponsible(Personnal $responsible): self
    {
        $this->responsible = $responsible;

        return $this;
    }

    public function getAncestorNode(): ?self
    {
        return $this->ancestorNode;
    }

    public function setAncestorNode(?self $ancestorNode): self
    {
        $this->ancestorNode = $ancestorNode;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getHospitalNodes(): Collection
    {
        return $this->hospitalNodes;
    }

    public function addHospitalNode(self $hospitalNode): self
    {
        if (!$this->hospitalNodes->contains($hospitalNode)) {
            $this->hospitalNodes[] = $hospitalNode;
            $hospitalNode->setAncestorNode($this);
        }

        return $this;
    }

    public function removeHospitalNode(self $hospitalNode): self
    {
        if ($this->hospitalNodes->contains($hospitalNode)) {
            $this->hospitalNodes->removeElement($hospitalNode);
            // set the owning side to null (unless already changed)
            if ($hospitalNode->getAncestorNode() === $this) {
                $hospitalNode->setAncestorNode(null);
            }
        }

        return $this;
    }

    public function getTypeNode(): ?TypeNode
    {
        return $this->typeNode;
    }

    public function setTypeNode(?TypeNode $typeNode): self
    {
        $this->typeNode = $typeNode;

        return $this;
    }

    /**
     * @return Collection|Personnal[]
     */
    public function getPersonnals(): Collection
    {
        return $this->personnals;
    }

    public function addPersonnal(Personnal $personnal): self
    {
        if (!$this->personnals->contains($personnal)) {
            $this->personnals[] = $personnal;
            $personnal->setAssignment($this);
        }

        return $this;
    }

    public function removePersonnal(Personnal $personnal): self
    {
        if ($this->personnals->contains($personnal)) {
            $this->personnals->removeElement($personnal);
            // set the owning side to null (unless already changed)
            if ($personnal->getAssignment() === $this) {
                $personnal->setAssignment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DMP[]
     */
    public function getDMPs(): Collection
    {
        return $this->dMPs;
    }

    public function addDMP(DMP $dMP): self
    {
        if (!$this->dMPs->contains($dMP)) {
            $this->dMPs[] = $dMP;
            $dMP->setNodeManaging($this);
        }

        return $this;
    }

    public function removeDMP(DMP $dMP): self
    {
        if ($this->dMPs->contains($dMP)) {
            $this->dMPs->removeElement($dMP);
            // set the owning side to null (unless already changed)
            if ($dMP->getNodeManaging() === $this) {
                $dMP->setNodeManaging(null);
            }
        }

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
            $history->setHospitalNode($this);
        }

        return $this;
    }

    public function removeHistory(History $history): self
    {
        if ($this->histories->contains($history)) {
            $this->histories->removeElement($history);
            // set the owning side to null (unless already changed)
            if ($history->getHospitalNode() === $this) {
                $history->setHospitalNode(null);
            }
        }

        return $this;
    }
}
