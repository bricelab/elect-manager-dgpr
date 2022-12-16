<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Repository\RapportOuvertureRepository;
use Bricelab\Doctrine\TimestampSetter;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RapportOuvertureRepository::class)]
#[ORM\UniqueConstraint(fields: ['arrondissement'])]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    uriTemplate: '/rapport-ouverture',
    operations: [
        new Post()
    ],
    denormalizationContext: ['groups' => ['Write:Item:RapportOuverture']],
)]
class RapportOuverture
{
    use TimestampSetter;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['Write:Item:RapportOuverture'])]
    private ?string $ouverture = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['Write:Item:RapportOuverture'])]
    private ?string $incidents = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['Write:Item:RapportOuverture'])]
    private ?string $difficultes = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['Write:Item:RapportOuverture'])]
    private ?Arrondissement $arrondissement = null;

    #[ORM\ManyToOne]
    private ?Utilisateur $auteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOuverture(): ?string
    {
        return $this->ouverture;
    }

    public function setOuverture(string $ouverture): self
    {
        $this->ouverture = $ouverture;

        return $this;
    }

    public function getIncidents(): ?string
    {
        return $this->incidents;
    }

    public function setIncidents(string $incidents): self
    {
        $this->incidents = $incidents;

        return $this;
    }

    public function getDifficultes(): ?string
    {
        return $this->difficultes;
    }

    public function setDifficultes(string $difficultes): self
    {
        $this->difficultes = $difficultes;

        return $this;
    }

    public function getArrondissement(): ?Arrondissement
    {
        return $this->arrondissement;
    }

    public function setArrondissement(?Arrondissement $arrondissement): self
    {
        $this->arrondissement = $arrondissement;

        return $this;
    }

    public function getAuteur(): ?Utilisateur
    {
        return $this->auteur;
    }

    public function setAuteur(?Utilisateur $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }
}
