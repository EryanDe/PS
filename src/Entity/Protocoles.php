<?php

namespace App\Entity;

use App\Repository\ProtocolesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProtocolesRepository::class)]
class Protocoles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_protocole = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description_protocole = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?string $prix_protocole = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_protocole = null;

    #[ORM\OneToMany(mappedBy: 'protocoles', targetEntity: exercices::class)]
    private Collection $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProtocole(): ?string
    {
        return $this->nom_protocole;
    }

    public function setNomProtocole(string $nom_protocole): static
    {
        $this->nom_protocole = $nom_protocole;

        return $this;
    }

    public function getDescriptionProtocole(): ?string
    {
        return $this->description_protocole;
    }

    public function setDescriptionProtocole(?string $description_protocole): static
    {
        $this->description_protocole = $description_protocole;

        return $this;
    }

    public function getPrixProtocole(): ?string
    {
        return $this->prix_protocole;
    }

    public function setPrixProtocole(string $prix_protocole): static
    {
        $this->prix_protocole = $prix_protocole;

        return $this;
    }

    public function getImageProtocole(): ?string
    {
        return $this->image_protocole;
    }

    public function setImageProtocole(?string $image_protocole): static
    {
        $this->image_protocole = $image_protocole;

        return $this;
    }

    /**
     * @return Collection<int, exercices>
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(exercices $relation): static
    {
        if (!$this->relation->contains($relation)) {
            $this->relation->add($relation);
            $relation->setProtocoles($this);
        }

        return $this;
    }

    public function removeRelation(exercices $relation): static
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getProtocoles() === $this) {
                $relation->setProtocoles(null);
            }
        }

        return $this;
    }
}
