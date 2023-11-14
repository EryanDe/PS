<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_article = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre_article = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contenu_article = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_creation_article = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $source_article = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $auteur_article = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageArticle(): ?string
    {
        return $this->image_article;
    }

    public function setImageArticle(?string $image_article): static
    {
        $this->image_article = $image_article;

        return $this;
    }

    public function getTitreArticle(): ?string
    {
        return $this->titre_article;
    }

    public function setTitreArticle(?string $titre_article): static
    {
        $this->titre_article = $titre_article;

        return $this;
    }

    public function getContenuArticle(): ?string
    {
        return $this->contenu_article;
    }

    public function setContenuArticle(?string $contenu_article): static
    {
        $this->contenu_article = $contenu_article;

        return $this;
    }

    public function getDateCreationArticle(): ?\DateTimeInterface
    {
        return $this->date_creation_article;
    }

    public function setDateCreationArticle(?\DateTimeInterface $date_creation_article): static
    {
        $this->date_creation_article = $date_creation_article;

        return $this;
    }

    public function getSourceArticle(): ?string
    {
        return $this->source_article;
    }

    public function setSourceArticle(?string $source_article): static
    {
        $this->source_article = $source_article;

        return $this;
    }

    public function getAuteurArticle(): ?string
    {
        return $this->auteur_article;
    }

    public function setAuteurArticle(?string $auteur_article): static
    {
        $this->auteur_article = $auteur_article;

        return $this;
    }
}
