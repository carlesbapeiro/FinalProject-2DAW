<?php

namespace App\Entity;

use App\Repository\AccioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccioRepository::class)
 */
class Accio
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $titol;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cos;

    /**
     * @ORM\ManyToOne(targetEntity=Professor::class, inversedBy="accions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $professor;

    /**
     * @ORM\ManyToOne(targetEntity=Representant::class, inversedBy="accions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $representant;

    /**
     * @ORM\ManyToOne(targetEntity=Practica::class, inversedBy="accions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $practica;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitol(): ?string
    {
        return $this->titol;
    }

    public function setTitol(string $titol): self
    {
        $this->titol = $titol;

        return $this;
    }

    public function getCos(): ?string
    {
        return $this->cos;
    }

    public function setCos(string $cos): self
    {
        $this->cos = $cos;

        return $this;
    }

    public function getProfessor(): ?Professor
    {
        return $this->professor;
    }

    public function setProfessor(?Professor $professor): self
    {
        $this->professor = $professor;

        return $this;
    }

    public function getRepresentant(): ?Representant
    {
        return $this->representant;
    }

    public function setRepresentant(?Representant $representant): self
    {
        $this->representant = $representant;

        return $this;
    }

    public function getPractica(): ?Practica
    {
        return $this->practica;
    }

    public function setPractica(?Practica $practica): self
    {
        $this->practica = $practica;

        return $this;
    }
}
