<?php

namespace App\Entity;

use App\Repository\RepresentantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RepresentantRepository::class)
 */
class Representant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotNull(message="El nom es obligatori")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotNull(message="El cognom es obligatori")
     */
    private $cognom;

    /**
     * @ORM\Column(type="string", length=9)
     * @Assert\NotNull(message="El telefon es obligatori")
     */
    private $telefon;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="El email es obligatori")
     */
    private $mail;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $alta = true;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poblacio;

    /**
     * @ORM\ManyToOne(targetEntity=Empresa::class, inversedBy="representants")
     * @Assert\NotNull(message="L'empresa es obligatoria")
     */
    private $empresa;

    /**
     * @ORM\OneToMany(targetEntity=Accio::class, mappedBy="representant")
     */
    private $accions;

    public function __construct()
    {
        $this->accions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCognom(): ?string
    {
        return $this->cognom;
    }

    public function setCognom(?string $cognom): self
    {
        $this->cognom = $cognom;

        return $this;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(?string $telefon): self
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAlta(): ?bool
    {
        return $this->alta;
    }

    public function setAlta(?bool $alta): self
    {
        $this->alta = $alta;

        return $this;
    }

    public function getPoblacio(): ?string
    {
        return $this->poblacio;
    }

    public function setPoblacio(?string $poblacio): self
    {
        $this->poblacio = $poblacio;

        return $this;
    }

    public function getEmpresa(): ?Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresa $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * @return Collection|Accio[]
     */
    public function getAccions(): Collection
    {
        return $this->accions;
    }

    public function addAccion(Accio $accion): self
    {
        if (!$this->accions->contains($accion)) {
            $this->accions[] = $accion;
            $accion->setRepresentant($this);
        }

        return $this;
    }

    public function removeAccion(Accio $accion): self
    {
        if ($this->accions->removeElement($accion)) {
            // set the owning side to null (unless already changed)
            if ($accion->getRepresentant() === $this) {
                $accion->setRepresentant(null);
            }
        }

        return $this;
    }
}
