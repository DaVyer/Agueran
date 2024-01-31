<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nomAnimal = null;

    #[ORM\Column(length: 150)]
    private ?string $lieuOriginaireAnimal = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descAnimal = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Famille $famille = null;

    #[ORM\ManyToOne(inversedBy: 'animal')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Enclos $enclos = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $image;

    #[ORM\ManyToOne(inversedBy: 'animal')]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: Utiliser::class)]
    private Collection $utilisers;

    public function __construct()
    {
        $this->utilisers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAnimal(): ?string
    {
        return $this->nomAnimal;
    }

    public function setNomAnimal(string $nomAnimal): static
    {
        $this->nomAnimal = $nomAnimal;

        return $this;
    }

    public function getLieuOriginaireAnimal(): ?string
    {
        return $this->lieuOriginaireAnimal;
    }

    public function setLieuOriginaireAnimal(string $lieuOriginaireAnimal): static
    {
        $this->lieuOriginaireAnimal = $lieuOriginaireAnimal;

        return $this;
    }

    public function getDescAnimal(): ?string
    {
        return $this->descAnimal;
    }

    public function setDescAnimal(?string $descAnimal): static
    {
        $this->descAnimal = $descAnimal;

        return $this;
    }

    public function getFamille(): ?Famille
    {
        return $this->famille;
    }

    public function setFamille(?Famille $famille): static
    {
        $this->famille = $famille;

        return $this;
    }

    public function getEnclos(): ?Enclos
    {
        return $this->enclos;
    }

    public function setEnclos(?Enclos $enclos): static
    {
        $this->enclos = $enclos;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Utiliser>
     */
    public function getUtilisers(): Collection
    {
        return $this->utilisers;
    }

    public function addUtiliser(Utiliser $utiliser): static
    {
        if (!$this->utilisers->contains($utiliser)) {
            $this->utilisers->add($utiliser);
            $utiliser->setAnimal($this);
        }

        return $this;
    }

    public function removeUtiliser(Utiliser $utiliser): static
    {
        if ($this->utilisers->removeElement($utiliser)) {
            // set the owning side to null (unless already changed)
            if ($utiliser->getAnimal() === $this) {
                $utiliser->setAnimal(null);
            }
        }

        return $this;
    }
}
