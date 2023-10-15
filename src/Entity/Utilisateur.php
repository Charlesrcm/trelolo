<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Un compte avec cette adresse email existe déjà')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
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
    #[ORM\Column(nullable: true)]
    private ?string $password = null;

    #[ORM\Column]
    private ?bool $is_admin = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Tache::class)]
    private Collection $taches;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Projet::class)]
    private Collection $projets;

    public function __construct()
    {
        $this->taches = new ArrayCollection();
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
        $roles[] = "ROLE_USER";
        // if($roles === 'ROLE_USER')
        //     $roles[] = 'ROLE_USER';
        // else $roles[] = 'ROLE_ADMIN';
        
        
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

    public function isIsAdmin(): ?bool
    {
        return $this->is_admin;
    }

    public function setIsAdmin(bool $is_admin): static
    {
        $this->is_admin = $is_admin;

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

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProj(Tache $proj): static
    {
        if (!$this->projets->contains($proj)) {
            $this->projets->add($proj);
            $proj->setUtilisateur($this);
        }

        return $this;
    }

    public function removeProj(Tache $proj): static
    {
        if ($this->projets->removeElement($proj)) {
            // set the owning side to null (unless already changed)
            if ($proj->getUtilisateur() === $this) {
                $proj->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }
    
    public function addTach(Tache $tach): static
    {
        if (!$this->taches->contains($tach)) {
            $this->taches->add($tach);
            $tach->setUtilisateur($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): static
    {
        if ($this->taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getUtilisateur() === $this) {
                $tach->setUtilisateur(null);
            }
        }

        return $this;
    }
}
