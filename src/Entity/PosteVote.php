<?php

namespace App\Entity;

use App\Repository\PosteVoteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PosteVoteRepository::class)]
class PosteVote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:Item:PosteVote'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:Item:PosteVote'])]
    private ?string $nom = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:Item:PosteVote'])]
    private ?CentreVote $centreVote = null;

    #[ORM\Column]
    private ?bool $estRemonte = null;

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

    public function getCentreVote(): ?CentreVote
    {
        return $this->centreVote;
    }

    public function setCentreVote(?CentreVote $centreVote): self
    {
        $this->centreVote = $centreVote;

        return $this;
    }

    public function isEstRemonte(): ?bool
    {
        return $this->estRemonte;
    }

    public function setEstRemonte(bool $estRemonte): self
    {
        $this->estRemonte = $estRemonte;

        return $this;
    }
}
