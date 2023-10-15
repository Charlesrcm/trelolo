<?php

namespace App\Entity;

use App\Repository\EtatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatRepository::class)]
class Etat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $libelle = null;

    #[ORM\OneToOne(mappedBy: 'etat', targetEntity:Tache::class, cascade: ['persist', 'remove'])]
    private ?Tache $tache = null;

    #[ORM\Column(length: 150)]
    private ?string $color = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getTache(): ?Tache
    {
        return $this->tache;
    }

    public function setTache(Tache $tache): static
    {
        // set the owning side of the relation if necessary
        if ($tache->getEtat() !== $this) {
            $tache->setEtat($this);
        }

        $this->tache = $tache;

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }
}
