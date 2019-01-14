<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeNodeRepository")
 */
class TypeNode
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HospitalNode", mappedBy="typeNode")
     */
    private $hospitalNodes;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    public function __construct()
    {
        $this->hospitalNodes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|HospitalNode[]
     */
    public function getHospitalNodes(): Collection
    {
        return $this->hospitalNodes;
    }

    public function addHospitalNode(HospitalNode $hospitalNode): self
    {
        if (!$this->hospitalNodes->contains($hospitalNode)) {
            $this->hospitalNodes[] = $hospitalNode;
            $hospitalNode->setTypeNode($this);
        }

        return $this;
    }

    public function removeHospitalNode(HospitalNode $hospitalNode): self
    {
        if ($this->hospitalNodes->contains($hospitalNode)) {
            $this->hospitalNodes->removeElement($hospitalNode);
            // set the owning side to null (unless already changed)
            if ($hospitalNode->getTypeNode() === $this) {
                $hospitalNode->setTypeNode(null);
            }
        }

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }
}
