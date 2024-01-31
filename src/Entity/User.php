<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 20)]
    private ?string $telephone = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse = null;

    #[ORM\Column(length: 6)]
    private ?string $codePostal = null;

    #[ORM\OneToMany(mappedBy: 'visiteur', targetEntity: Billet::class, cascade: ['remove'])]
    private Collection $billets;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Reserver::class, cascade: ['remove'])]
    private Collection $reserver;

    #[ORM\Column(length: 255)]
    private ?string $pays = null;

    public function __construct()
    {
        $this->billets = new ArrayCollection();
        $this->reserver = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * @return Collection<int, Billet>
     */
    public function getBillets(): Collection
    {
        return $this->billets;
    }

    public function addBillet(Billet $billet): static
    {
        if (!$this->billets->contains($billet)) {
            $this->billets->add($billet);
            $billet->setVisiteur($this);
        }

        return $this;
    }

    public function removeBillet(Billet $billet): static
    {
        if ($this->billets->removeElement($billet)) {
            // set the owning side to null (unless already changed)
            if ($billet->getVisiteur() === $this) {
                $billet->setVisiteur(null);
            }
        }

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Reserver>
     */
    public function getReserver(): Collection
    {
        return $this->reserver;
    }

    public function addReserver(Reserver $reserver): static
    {
        if (!$this->reserver->contains($reserver)) {
            $this->reserver->add($reserver);
            $reserver->setUser($this);
        }

        return $this;
    }

    public function removeReserver(Reserver $reserver): static
    {
        if ($this->reserver->removeElement($reserver)) {
            // set the owning side to null (unless already changed)
            if ($reserver->getUser() === $this) {
                $reserver->setUser(null);
            }
        }

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('prenom', new Assert\NotBlank());
        $metadata->addPropertyConstraint('prenom', new Assert\Length([
            'max' => 30,
            'maxMessage' => 'Votre prénom ne peut pas contenir plus de {{ limit }} caractères',
        ]));
        $metadata->addPropertyConstraint('nom', new Assert\NotBlank());
        $metadata->addPropertyConstraint('nom', new Assert\Length([
            'max' => 40,
            'maxMessage' => 'Votre nom ne peut pas contenir plus de {{ limit }} caractères',
        ]));
        $metadata->addPropertyConstraint('email', new Assert\NotBlank());
        $metadata->addPropertyConstraint('email', new Assert\Length([
            'max' => 100,
            'maxMessage' => 'Votre email ne peut pas contenir plus de {{ limit }} caractères',
        ]));
        $metadata->addPropertyConstraint('email', new Assert\Email([
            'message' => 'L\'email "{{ value }}" n\'est pas valide !',
        ]));
        $metadata->addPropertyConstraint('telephone', new Assert\NotBlank());
        $metadata->addPropertyConstraint('telephone', new Assert\Length([
            'max' => 100,
            'maxMessage' => 'Votre téléphone ne peut pas contenir plus de {{ limit }} caractères',
        ]));
        $metadata->addPropertyConstraint('telephone', new Assert\Regex([
            'pattern' => '/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4})$/',
            'message' => 'Format de téléphone invalide !',
        ]));
    }

    public function __toString()
    {
        return $this->prenom.' '.$this->nom;
    }
}
