<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ArrondissementRepository;
use Bricelab\Doctrine\TimestampSetter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ArrondissementRepository::class)]
#[ORM\UniqueConstraint(fields: ['nom', 'commune'])]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
    ]
)]
class Arrondissement
{
    use TimestampSetter;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:Item:Me'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:Item:Me'])]
    private ?string $nom = null;

    #[ORM\Column(nullable: false)]
    #[Groups(['read:Item:Me'])]
    private bool $rapportOuvertureRempli = false;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commune $commune = null;

    public function __toString(): string
    {
        return $this->getNom();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom . ' (' . $this->commune->getNom() . ')';
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    #[Groups(['read:Item:Me'])]
    public function getCommuneUri(): string
    {
        return '/api/communes/' . $this->commune->getId();
    }

    public function getRapportOuvertureRempli(): bool
    {
        return $this->rapportOuvertureRempli;
    }

    public function setRapportOuvertureRempli(bool $rapportOuvertureRempli): self
    {
        $this->rapportOuvertureRempli = $rapportOuvertureRempli;

        return $this;
    }
}
