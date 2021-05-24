<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="villes")
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $interet;

    /**
     * @ORM\OneToMany(targetEntity=Monument::class, mappedBy="ville")
     */
    private $monuments;

    public function __construct()
    {
        $this->monuments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getInteret(): ?string
    {
        return $this->interet;
    }

    public function setInteret(?string $interet): self
    {
        $this->interet = $interet;

        return $this;
    }

    /**
     * @return Collection|Monument[]
     */
    public function getMonuments(): Collection
    {
        return $this->monuments;
    }

    public function addMonument(Monument $monument): self
    {
        if (!$this->monuments->contains($monument)) {
            $this->monuments[] = $monument;
            $monument->setVille($this);
        }

        return $this;
    }

    public function removeMonument(Monument $monument): self
    {
        if ($this->monuments->removeElement($monument)) {
            // set the owning side to null (unless already changed)
            if ($monument->getVille() === $this) {
                $monument->setVille(null);
            }
        }

        return $this;
    }
}
