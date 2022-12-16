<?php

namespace App\Entity;

use App\Repository\DonneesPosteVoteRepository;
use Bricelab\Doctrine\TimestampSetter;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DonneesPosteVoteRepository::class)]
#[ORM\UniqueConstraint(fields: ['posteVote'])]
#[ORM\HasLifecycleCallbacks]
class DonneesPosteVote
{
    use TimestampSetter;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?PosteVote $posteVote = null;

    #[ORM\Column]
    private ?int $nbInscrits = null;

    #[ORM\Column]
    private ?int $nbVotants = null;

    #[ORM\Column]
    private ?int $nbBulletinsNuls = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $remontePar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosteVote(): ?PosteVote
    {
        return $this->posteVote;
    }

    public function setPosteVote(?PosteVote $posteVote): self
    {
        $this->posteVote = $posteVote;

        return $this;
    }

    public function getNbInscrits(): ?int
    {
        return $this->nbInscrits;
    }

    public function setNbInscrits(int $nbInscrits): self
    {
        $this->nbInscrits = $nbInscrits;

        return $this;
    }

    public function getNbVotants(): ?int
    {
        return $this->nbVotants;
    }

    public function setNbVotants(int $nbVotants): self
    {
        $this->nbVotants = $nbVotants;

        return $this;
    }

    public function getNbBulletinsNuls(): ?int
    {
        return $this->nbBulletinsNuls;
    }

    public function setNbBulletinsNuls(int $nbBulletinsNuls): self
    {
        $this->nbBulletinsNuls = $nbBulletinsNuls;

        return $this;
    }

    public function getRemontePar(): ?Utilisateur
    {
        return $this->remontePar;
    }

    public function setRemontePar(?Utilisateur $remontePar): self
    {
        $this->remontePar = $remontePar;

        return $this;
    }
}
