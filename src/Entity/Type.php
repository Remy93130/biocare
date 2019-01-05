<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type
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
     * @ORM\OneToMany(targetEntity="App\Entity\Acts", mappedBy="type")
     */
    private $acts;

    public function __construct()
    {
        $this->acts = new ArrayCollection();
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
            $act->setType($this);
        }

        return $this;
    }

    public function removeAct(Acts $act): self
    {
        if ($this->acts->contains($act)) {
            $this->acts->removeElement($act);
            // set the owning side to null (unless already changed)
            if ($act->getType() === $this) {
                $act->setType(null);
            }
        }

        return $this;
    }
}
