<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomAdmin = null;

    #[ORM\Column(length: 255)]
    private ?string $PrenomAdmin = null;

    #[ORM\Column(length: 255)]
    private ?string $EmailAdmin = null;

    #[ORM\Column(length: 255)]
    private ?string $MotDePasse = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAdmin(): ?string
    {
        return $this->NomAdmin;
    }

    public function setNomAdmin(string $NomAdmin): static
    {
        $this->NomAdmin = $NomAdmin;

        return $this;
    }

    public function getPrenomAdmin(): ?string
    {
        return $this->PrenomAdmin;
    }

    public function setPrenomAdmin(string $PrenomAdmin): static
    {
        $this->PrenomAdmin = $PrenomAdmin;

        return $this;
    }

    public function getEmailAdmin(): ?string
    {
        return $this->EmailAdmin;
    }

    public function setEmailAdmin(string $EmailAdmin): static
    {
        $this->EmailAdmin = $EmailAdmin;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->MotDePasse;
    }

    public function setMotDePasse(string $MotDePasse): static
    {
        $this->MotDePasse = $MotDePasse;

        return $this;
    }
}
