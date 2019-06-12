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
     * @ORM\OneToMany(targetEntity="App\Entity\Enterprise", mappedBy="type")
     */
    private $enterprise;

    public function __construct()
    {
        $this->enterprise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Enterprise[]
     */
    public function getEnterprise(): Collection
    {
        return $this->enterprise;
    }

    public function addEnterprise(Enterprise $enterprise): self
    {
        if (!$this->enterprise->contains($enterprise)) {
            $this->enterprise[] = $enterprise;
            $enterprise->setType($this);
        }

        return $this;
    }

    public function removeEnterprise(Enterprise $enterprise): self
    {
        if ($this->enterprise->contains($enterprise)) {
            $this->enterprise->removeElement($enterprise);
            // set the owning side to null (unless already changed)
            if ($enterprise->getType() === $this) {
                $enterprise->setType(null);
            }
        }

        return $this;
    }
}
