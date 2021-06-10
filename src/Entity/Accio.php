<?php

namespace App\Entity;

use App\Repository\AccioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotNull(message="El titol es obligatori")
     */
    private $titol;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="El cos es obligatori")
     */
    private $cos;

    /**
     * @ORM\ManyToOne(targetEntity=Professor::class, inversedBy="accions")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull(message="El professor es obligatori")
     */
    private $professor;

    /**
     * @ORM\ManyToOne(targetEntity=Representant::class, inversedBy="accions")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull(message="El representant es obligatori")
     */
    private $representant;

    /**
     * @ORM\ManyToOne(targetEntity=Practica::class, inversedBy="accions")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull(message="Les practiques son obligatories")
     */
    private $practica;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull(message="La data es obligatoria")
     */
    private $data;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitol(): ?string
    {
        return $this->titol;
    }

    public function setTitol(?string $titol): self
    {
        $this->titol = $titol;

        return $this;
    }

    public function getCos(): ?string
    {
        return $this->cos;
    }

    public function setCos(?string $cos): self
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

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(?\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }
}
