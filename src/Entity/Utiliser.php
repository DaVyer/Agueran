<?php

namespace App\Entity;

use App\Repository\UtiliserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtiliserRepository::class)]
class Utiliser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $lieu = null;

    #[ORM\ManyToOne(inversedBy: 'utilisers')]
    private ?Animal $animal = null;

    #[ORM\ManyToOne(inversedBy: 'utilisers')]
    private ?Activite $activiter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function getActiviter(): ?Activite
    {
        return $this->activiter;
    }

    public function setActiviter(?Activite $activite): static
    {
        $this->activiter = $activite;

        return $this;
    }
}
