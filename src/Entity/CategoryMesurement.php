<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryMesurementRepository")
 */
class CategoryMesurement
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
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mesurement", mappedBy="category")
     */
    private $mesurements;

    public function __construct()
    {
        $this->mesurements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Mesurement[]
     */
    public function getMesurements(): Collection
    {
        return $this->mesurements;
    }

    public function addMesurement(Mesurement $mesurement): self
    {
        if (!$this->mesurements->contains($mesurement)) {
            $this->mesurements[] = $mesurement;
            $mesurement->setCategory($this);
        }

        return $this;
    }

    public function removeMesurement(Mesurement $mesurement): self
    {
        if ($this->mesurements->contains($mesurement)) {
            $this->mesurements->removeElement($mesurement);
            // set the owning side to null (unless already changed)
            if ($mesurement->getCategory() === $this) {
                $mesurement->setCategory(null);
            }
        }

        return $this;
    }
}
