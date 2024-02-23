<?php

namespace App\Entity;

use App\Repository\CommandeLivreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeLivreRepository::class)]
class CommandeLivre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $IdLivre = null;

    #[ORM\Column]
    private ?int $IdCommande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdLivre(): ?int
    {
        return $this->IdLivre;
    }

    public function setIdLivre(int $IdLivre): static
    {
        $this->IdLivre = $IdLivre;

        return $this;
    }

    public function getIdCommande(): ?int
    {
        return $this->IdCommande;
    }

    public function setIdCommande(int $IdCommande): static
    {
        $this->IdCommande = $IdCommande;

        return $this;
    }
}
