<?php

namespace App\Entity;

use App\Repository\PortefeuilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PortefeuilleRepository::class)
 */
class Portefeuille
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
    private $nom;



    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="portefeuilles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Placement::class, mappedBy="portefeuille", orphanRemoval=true)
     */
    private $placements;

    public function __construct()
    {
        $this->placements = new ArrayCollection();
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Placement[]
     */
    public function getPlacements(): Collection
    {
        return $this->placements;
    }

    public function addPlacement(Placement $placement): self
    {
        if (!$this->placements->contains($placement)) {
            $this->placements[] = $placement;
            $placement->setPortefeuille($this);
        }

        return $this;
    }

    public function removePlacement(Placement $placement): self
    {
        if ($this->placements->contains($placement)) {
            $this->placements->removeElement($placement);
            // set the owning side to null (unless already changed)
            if ($placement->getPortefeuille() === $this) {
                $placement->setPortefeuille(null);
            }
        }

        return $this;
    }


}
