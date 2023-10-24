<?php

namespace App\Entity;

use App\Repository\SemainesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemainesRepository::class)]
class Semaines
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_semaine = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_debut_semaine = null;

    #[ORM\Column(nullable: true)]
    private ?bool $etat_semaine = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $pourcentage_realiser_semaine = null;

    #[ORM\OneToMany(mappedBy: 'semaines', targetEntity: exercices::class)]
    private Collection $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreSemaine(): ?string
    {
        return $this->titre_semaine;
    }

    public function setTitreSemaine(string $titre_semaine): static
    {
        $this->titre_semaine = $titre_semaine;

        return $this;
    }

    public function getDateDebutSemaine(): ?\DateTimeInterface
    {
        return $this->date_debut_semaine;
    }

    public function setDateDebutSemaine(?\DateTimeInterface $date_debut_semaine): static
    {
        $this->date_debut_semaine = $date_debut_semaine;

        return $this;
    }

    public function isEtatSemaine(): ?bool
    {
        return $this->etat_semaine;
    }

    public function setEtatSemaine(?bool $etat_semaine): static
    {
        $this->etat_semaine = $etat_semaine;

        return $this;
    }

    public function getPourcentageRealiserSemaine(): ?string
    {
        return $this->pourcentage_realiser_semaine;
    }

    public function setPourcentageRealiserSemaine(?string $pourcentage_realiser_semaine): static
    {
        $this->pourcentage_realiser_semaine = $pourcentage_realiser_semaine;

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
            $relation->setSemaines($this);
        }

        return $this;
    }

    public function removeRelation(exercices $relation): static
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getSemaines() === $this) {
                $relation->setSemaines(null);
            }
        }

        return $this;
    }
}
