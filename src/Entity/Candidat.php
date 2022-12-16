<?php

namespace App\Entity;

use App\Repository\CandidatRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CandidatRepository::class)]
#[ORM\UniqueConstraint(columns: ['nom', 'sigle'])]
class Candidat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:Item:Me'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:Item:Me'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:Item:Me'])]
    private ?string $sigle = null;

    #[ORM\Column]
    #[Groups(['read:Item:Me'])]
    private ?int $position = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:Item:Me'])]
    private ?string $logo = null;

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

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(string $sigle): self
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }
}
