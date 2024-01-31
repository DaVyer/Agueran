<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActiviteRepository::class)]
class Activite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $libActivite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateActivite = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heureDebutActivite = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heureFinActivite = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descActivite = null;

    #[ORM\Column]
    private ?int $nbVisiteurMaxActivite = null;

    #[ORM\Column(nullable: true)]
    private ?int $tarifActivite = null;

    #[ORM\OneToMany(mappedBy: 'activite', targetEntity: Reserver::class, orphanRemoval: true)]
    private Collection $reservations;

    #[ORM\OneToMany(mappedBy: 'activite', targetEntity: Enclos::class)]
    private Collection $enclos;

    #[ORM\Column]
    private ?bool $estActiviteAnimal = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $image;

    #[ORM\OneToMany(mappedBy: 'activiter', targetEntity: Utiliser::class)]
    private Collection $utilisers;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->enclos = new ArrayCollection();
        $this->utilisers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibActivite(): ?string
    {
        return $this->libActivite;
    }

    public function setLibActivite(string $libActivite): static
    {
        $this->libActivite = $libActivite;

        return $this;
    }

    public function getDateActivite(): ?\DateTimeInterface
    {
        return $this->dateActivite;
    }

    public function setDateActivite(\DateTimeInterface $dateActivite): static
    {
        $this->dateActivite = $dateActivite;

        return $this;
    }

    public function getHeureDebutActivite(): ?\DateTimeInterface
    {
        return $this->heureDebutActivite;
    }

    public function setHeureDebutActivite(\DateTimeInterface $heureDebutActivite): static
    {
        $this->heureDebutActivite = $heureDebutActivite;

        return $this;
    }

    public function getHeureFinActivite(): ?\DateTimeInterface
    {
        return $this->heureFinActivite;
    }

    public function setHeureFinActivite(\DateTimeInterface $heureFinActivite): static
    {
        $this->heureFinActivite = $heureFinActivite;

        return $this;
    }

    public function getDescActivite(): ?string
    {
        return $this->descActivite;
    }

    public function setDescActivite(?string $descActivite): static
    {
        $this->descActivite = $descActivite;

        return $this;
    }

    public function getNbVisiteurMaxActivite(): ?int
    {
        return $this->nbVisiteurMaxActivite;
    }

    public function setNbVisiteurMaxActivite(int $nbVisiteurMaxActivite): static
    {
        $this->nbVisiteurMaxActivite = $nbVisiteurMaxActivite;

        return $this;
    }

    public function getTarifActivite(): ?int
    {
        return $this->tarifActivite;
    }

    public function setTarifActivite(?int $tarifActivite): static
    {
        $this->tarifActivite = $tarifActivite;

        return $this;
    }

    /**
     * @return Collection<int, Reserver>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reserver $reserver): static
    {
        if (!$this->reservations->contains($reserver)) {
            $this->reservations->add($reserver);
            $reserver->setActivite($this);
        }

        return $this;
    }

    public function removeReservation(Reserver $reserver): static
    {
        if ($this->reservations->removeElement($reserver)) {
            // set the owning side to null (unless already changed)
            if ($reserver->getActivite() === $this) {
                $reserver->setActivite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Enclos>
     */
    public function getEnclos(): Collection
    {
        return $this->enclos;
    }

    public function addEnclos(Enclos $enclos): static
    {
        if (!$this->enclos->contains($enclos)) {
            $this->enclos->add($enclos);
            $enclos->setActivite($this);
        }

        return $this;
    }

    public function removeEnclos(Enclos $enclos): static
    {
        if ($this->enclos->removeElement($enclos)) {
            // set the owning side to null (unless already changed)
            if ($enclos->getActivite() === $this) {
                $enclos->setActivite(null);
            }
        }

        return $this;
    }

    public function isEstActiviteAnimal(): ?bool
    {
        return $this->estActiviteAnimal;
    }

    public function setEstActiviteAnimal(bool $estActiviteAnimal): static
    {
        $this->estActiviteAnimal = $estActiviteAnimal;

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
            $utiliser->setActiviter($this);
        }

        return $this;
    }

    public function removeUtiliser(Utiliser $utiliser): static
    {
        if ($this->utilisers->removeElement($utiliser)) {
            // set the owning side to null (unless already changed)
            if ($utiliser->getActiviter() === $this) {
                $utiliser->setActiviter(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->libActivite;
    }
}
