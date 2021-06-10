<?php

namespace App\Entity;

use App\Repository\EmpresaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EmpresaRepository::class)
 */
class Empresa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=9)
     * @Assert\NotNull(message="El cif es obligatori")
     */
    private $cif;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotNull(message="El nom es obligatori")
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull(message="El telefon es obligatori")
     */
    private $telefon;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="El mail es obligatori")
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="La adreça es obligatoria")
     */
    private $adresa;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $hora_entrada;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $hora_eixida;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $alta = true;

    /**
     * @ORM\OneToMany(targetEntity=Representant::class, mappedBy="empresa")
     */
    private $representants;

    /**
     * @ORM\OneToMany(targetEntity=Practica::class, mappedBy="empresa")
     */
    private $practiques;

    public function __construct()
    {
        $this->representants = new ArrayCollection();
        $this->practiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCif(): ?string
    {
        return $this->cif;
    }

    public function setCif(?string $cif): self
    {
        $this->cif = $cif;

        return $this;
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

    public function getTelefon(): ?int
    {
        return $this->telefon;
    }

    public function setTelefon(?int $telefon): self
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

    public function getAdresa(): ?string
    {
        return $this->adresa;
    }

    public function setAdresa(?string $adresa): self
    {
        $this->adresa = $adresa;

        return $this;
    }

    public function getHoraEntrada(): ?\DateTimeInterface
    {
        return $this->hora_entrada;
    }

    public function setHoraEntrada(?\DateTimeInterface $hora_entrada): self
    {
        $this->hora_entrada = $hora_entrada;

        return $this;
    }

    public function getHoraEixida(): ?\DateTimeInterface
    {
        return $this->hora_eixida;
    }

    public function setHoraEixida(?\DateTimeInterface $hora_eixida): self
    {
        $this->hora_eixida = $hora_eixida;

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

    /**
     * @return Collection|Representant[]
     */
    public function getRepresentants(): Collection
    {
        return $this->representants;
    }

    public function addRepresentant(Representant $representant): self
    {
        if (!$this->representants->contains($representant)) {
            $this->representants[] = $representant;
            $representant->setEmpresa($this);
        }

        return $this;
    }

    public function removeRepresentant(Representant $representant): self
    {
        if ($this->representants->removeElement($representant)) {
            // set the owning side to null (unless already changed)
            if ($representant->getEmpresa() === $this) {
                $representant->setEmpresa(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Practica[]
     */
    public function getPractiques(): Collection
    {
        return $this->practiques;
    }

    public function addPractique(Practica $practique): self
    {
        if (!$this->practiques->contains($practique)) {
            $this->practiques[] = $practique;
            $practique->setEmpresa($this);
        }

        return $this;
    }

    public function removePractique(Practica $practique): self
    {
        if ($this->practiques->removeElement($practique)) {
            // set the owning side to null (unless already changed)
            if ($practique->getEmpresa() === $this) {
                $practique->setEmpresa(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->nom;
    }
}
