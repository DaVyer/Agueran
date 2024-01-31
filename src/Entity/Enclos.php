<?php

namespace App\Entity;

use App\Repository\EnclosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnclosRepository::class)]
class Enclos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nomEnclos = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descEnclos = null;

    #[ORM\OneToMany(mappedBy: 'enclos', targetEntity: Animal::class)]
    private Collection $animal;

    #[ORM\ManyToOne(inversedBy: 'enclos')]
    private ?Activite $activite = null;

    public function __construct()
    {
        $this->animal = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEnclos(): ?string
    {
        return $this->nomEnclos;
    }

    public function setNomEnclos(string $nomEnclos): static
    {
        $this->nomEnclos = $nomEnclos;

        return $this;
    }

    public function getDescEnclos(): ?string
    {
        return $this->descEnclos;
    }

    public function setDescEnclos(?string $descEnclos): static
    {
        $this->descEnclos = $descEnclos;

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimal(): Collection
    {
        return $this->animal;
    }

    public function addAnimal(Animal $animal): static
    {
        if (!$this->animal->contains($animal)) {
            $this->animal->add($animal);
            $animal->setEnclos($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animal->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getEnclos() === $this) {
                $animal->setEnclos(null);
            }
        }

        return $this;
    }

    public function getActivite(): ?Activite
    {
        return $this->activite;
    }

    public function setActivite(?Activite $activite): static
    {
        $this->activite = $activite;

        return $this;
    }

    public function __toString()
    {
        return $this->nomEnclos;
    }
}
