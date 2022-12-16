<?php

namespace App\Entity;

use App\Repository\CentreVoteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CentreVoteRepository::class)]
class CentreVote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:Item:CentreVote', 'read:Item:PosteVote'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:Item:CentreVote', 'read:Item:PosteVote'])]
    private ?string $nom = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?VillageQuartier $villageQuartier = null;

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

    public function getVillageQuartier(): ?VillageQuartier
    {
        return $this->villageQuartier;
    }

    public function setVillageQuartier(?VillageQuartier $villageQuartier): self
    {
        $this->villageQuartier = $villageQuartier;

        return $this;
    }
}
