<?php

namespace App\Entity;

use App\Repository\SuffragesObtenusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuffragesObtenusRepository::class)]
class SuffragesObtenus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Candidat $candidat = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?PosteVote $posteVote = null;

    #[ORM\Column]
    private ?int $nbVoix = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCandidat(): ?Candidat
    {
        return $this->candidat;
    }

    public function setCandidat(?Candidat $candidat): self
    {
        $this->candidat = $candidat;

        return $this;
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

    public function getNbVoix(): ?int
    {
        return $this->nbVoix;
    }

    public function setNbVoix(int $nbVoix): self
    {
        $this->nbVoix = $nbVoix;

        return $this;
    }
}
