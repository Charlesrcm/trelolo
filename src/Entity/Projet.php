<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_projet = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $d_creation = null;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: Tache::class, orphanRemoval: true)]
    private Collection $taches;

    // #[ORM\ManyToOne(inversedBy: 'utilisateur', targetEntity: Admin::class)]
    // // #[ORM\JoinColumn(nullable: false)]
    // private ?Admin $admin = null;

    #[ORM\ManyToOne(inversedBy: 'projets', targetEntity: Priorite::class)]
    // #[ORM\JoinColumn(nullable: false)]
    private $priorite;

    #[ORM\ManyToOne(inversedBy: 'projets', targetEntity: Utilisateur::class)]
    #[ORM\JoinColumn(nullable: false, referencedColumnName:'id')]
    private ?Utilisateur $utilisateur = null;

    public function __construct()
    {
        $this->taches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProjet(): ?string
    {
        return $this->nom_projet;
    }

    public function setNomProjet(string $nom_projet): static
    {
        $this->nom_projet = $nom_projet;

        return $this;
    }

    public function getDCreation(): ?\DateTimeInterface
    {
        return $this->d_creation;
    }

    public function setDCreation(\DateTimeInterface $d_creation): static
    {
        
        $this->d_creation = $d_creation;

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
            $tach->setProjet($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): static
    {
        if ($this->taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getProjet() === $this) {
                $tach->setProjet(null);
            }
        }

        return $this;
    }

    public function getPriorite(): ?Priorite
    {
        return $this->priorite;
    }

    public function setPriorite(?Priorite $priorite): static
    {
        $this->priorite = $priorite;

        return $this;
    }

    public function __toString()
    {
        return $this->nom_projet;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur_id): static
    {
        $this->utilisateur = $utilisateur_id;

        return $this;
    }

}
