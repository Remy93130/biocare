<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 */
class File
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Acts", inversedBy="files")
     * @ORM\JoinColumn(nullable=false)
     */
    private $act;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getAct(): ?Acts
    {
        return $this->act;
    }

    public function setAct(?Acts $act): self
    {
        $this->act = $act;

        return $this;
    }
}
