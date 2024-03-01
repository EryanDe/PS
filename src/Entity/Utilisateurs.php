<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateursRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Utilisateurs implements UserInterface, PasswordAuthenticatedUserInterface
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

    #[ORM\Column(length: 255)]
    private ?string $nom_utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom_utilisateur = null;

    #[ORM\Column]
    private ?int $numero_rue_utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $rue_utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $ville_utilisateur = null;

    #[ORM\Column(length: 15)]
    private ?string $code_postal_utilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $pays_utilisateur = null;

    #[ORM\Column(length: 20)]
    private ?string $telephone_utilisateur = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    private ?Protocoles $relation = null;

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

    public function getNomUtilisateur(): ?string
    {
        return $this->nom_utilisateur;
    }

    public function setNomUtilisateur(string $nom_utilisateur): static
    {
        $this->nom_utilisateur = $nom_utilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenom_utilisateur;
    }
    
    public function setPrenomUtilisateur(?string $prenom_utilisateur): static
    {
        $this->prenom_utilisateur = $prenom_utilisateur;
    
        return $this;
    }

    





    public function getNumeroRueUtilisateur(): ?int
    {
        return $this->numero_rue_utilisateur;
    }

    public function setNumeroRueUtilisateur(int $numero_rue_utilisateur): static
    {
        $this->numero_rue_utilisateur = $numero_rue_utilisateur;

        return $this;
    }

    public function getRueUtilisateur(): ?string
    {
        return $this->rue_utilisateur;
    }

    public function setRueUtilisateur(string $rue_utilisateur): static
    {
        $this->rue_utilisateur = $rue_utilisateur;

        return $this;
    }

    public function getVilleUtilisateur(): ?string
    {
        return $this->ville_utilisateur;
    }

    public function setVilleUtilisateur(string $ville_utilisateur): static
    {
        $this->ville_utilisateur = $ville_utilisateur;

        return $this;
    }

    public function getCodePostalUtilisateur(): ?string
    {
        return $this->code_postal_utilisateur;
    }

    public function setCodePostalUtilisateur(string $code_postal_utilisateur): static
    {
        $this->code_postal_utilisateur = $code_postal_utilisateur;

        return $this;
    }

    public function getPaysUtilisateur(): ?string
    {
        return $this->pays_utilisateur;
    }

    public function setPaysUtilisateur(string $pays_utilisateur): static
    {
        $this->pays_utilisateur = $pays_utilisateur;

        return $this;
    }

    public function getTelephoneUtilisateur(): ?string
    {
        return $this->telephone_utilisateur;
    }

    public function setTelephoneUtilisateur(string $telephone_utilisateur): static
    {
        $this->telephone_utilisateur = $telephone_utilisateur;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getRelation(): ?protocoles
    {
        return $this->relation;
    }

    public function setRelation(?protocoles $relation): static
    {
        $this->relation = $relation;

        return $this;
    }


    #[ORM\Column(length: 255)]
    private ?string $stripe_CustomerId = null;

    private $stripeCustomerId;

    // Getter et Setter pour stripeCustomerId

    public function getStripeCustomerId(): ?string
    {
        return $this->stripeCustomerId;
    }

    public function setStripeCustomerId(?string $stripeCustomerId): self
    {
        $this->stripeCustomerId = $stripeCustomerId;

        return $this;
    }

    public function isRegisteredToProtocole(Protocoles $protocole): bool
{
    return $this->relation !== null && $this->relation->getId() === $protocole->getId();
}

}
