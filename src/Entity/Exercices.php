<?php

namespace App\Entity;

use App\Repository\ExercicesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExercicesRepository::class)]
class Exercices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_exercice = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $duree_exercice = null;

    #[ORM\Column(nullable: true)]
    private ?int $frequence_exercice = null;

    #[ORM\Column(nullable: true)]
    private ?bool $etat_exercice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description_exercice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $materiel_exercice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contenu_facile_exercice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contenu_difficile_exercice = null;

    #[ORM\ManyToOne(inversedBy: 'relation', cascade:  ["persist"])]
    private ?Protocoles $protocoles = null;

    #[ORM\ManyToOne(inversedBy: 'relation', cascade:  ["persist"])]
    private ?Semaines $semaines = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreExercice(): ?string
    {
        return $this->titre_exercice;
    }

    public function setTitreExercice(string $titre_exercice): static
    {
        $this->titre_exercice = $titre_exercice;

        return $this;
    }

    public function getDureeExercice(): ?string
    {
        return $this->duree_exercice;
    }

    public function setDureeExercice(?string $duree_exercice): static
    {
        $this->duree_exercice = $duree_exercice;

        return $this;
    }

    public function getFrequenceExercice(): ?int
    {
        return $this->frequence_exercice;
    }

    public function setFrequenceExercice(?int $frequence_exercice): static
    {
        $this->frequence_exercice = $frequence_exercice;

        return $this;
    }

    public function isEtatExercice(): ?bool
    {
        return $this->etat_exercice;
    }

    public function setEtatExercice(?bool $etat_exercice): static
    {
        $this->etat_exercice = $etat_exercice;

        return $this;
    }

    public function getDescriptionExercice(): ?string
    {
        return $this->description_exercice;
    }

    public function setDescriptionExercice(?string $description_exercice): static
    {
        $this->description_exercice = $description_exercice;

        return $this;
    }

    public function getMaterielExercice(): ?string
    {
        return $this->materiel_exercice;
    }

    public function setMaterielExercice(?string $materiel_exercice): static
    {
        $this->materiel_exercice = $materiel_exercice;

        return $this;
    }

    public function getContenuFacileExercice(): ?string
    {
        return $this->contenu_facile_exercice;
    }

    public function setContenuFacileExercice(?string $contenu_facile_exercice): static
    {
        $this->contenu_facile_exercice = $contenu_facile_exercice;

        return $this;
    }

    public function getContenuDifficileExercice(): ?string
    {
        return $this->contenu_difficile_exercice;
    }

    public function setContenuDifficileExercice(?string $contenu_difficile_exercice): static
    {
        $this->contenu_difficile_exercice = $contenu_difficile_exercice;

        return $this;
    }

    public function getProtocoles(): ?Protocoles
    {
        return $this->protocoles;
    }

    public function setProtocoles(?Protocoles $protocoles): static
    {
        $this->protocoles = $protocoles;

        return $this;
    }

    public function getSemaines(): ?Semaines
    {
        return $this->semaines;
    }

    public function setSemaines(?Semaines $semaines): static
    {
        $this->semaines = $semaines;

        return $this;
    }
}
