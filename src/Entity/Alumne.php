<?php

namespace App\Entity;

use App\Repository\AlumneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlumneRepository::class)
 */
class Alumne
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $cognom;

    /**
     * @ORM\Column(type="integer")
     */
    private $telefon;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $direccio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observacions;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $alta;

    /**
     * @ORM\ManyToMany(targetEntity=Cicle::class, inversedBy="alumnes", cascade={"persist"})
     */
    private $cicle;

    /**
     * @ORM\ManyToOne(targetEntity=Professor::class, inversedBy="alumnes", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $professor;

    /**
     * @ORM\OneToMany(targetEntity=Practica::class, mappedBy="alumne")
     */
    private $practiques;

    public function __construct()
    {
        $this->cicle = new ArrayCollection();
        $this->practiques = new ArrayCollection();
    }

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

    public function getCognom(): ?string
    {
        return $this->cognom;
    }

    public function setCognom(string $cognom): self
    {
        $this->cognom = $cognom;

        return $this;
    }

    public function getTelefon(): ?int
    {
        return $this->telefon;
    }

    public function setTelefon(int $telefon): self
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getDireccio(): ?string
    {
        return $this->direccio;
    }

    public function setDireccio(string $direccio): self
    {
        $this->direccio = $direccio;

        return $this;
    }

    public function getObservacions(): ?string
    {
        return $this->observacions;
    }

    public function setObservacions(?string $observacions): self
    {
        $this->observacions = $observacions;

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
     * @return Collection|Cicle[]
     */
    public function getCicle(): Collection
    {
        return $this->cicle;
    }

    public function addCicle(Cicle $cicle): self
    {
        if (!$this->cicle->contains($cicle)) {
            $this->cicle[] = $cicle;
        }

        return $this;

    }

    public function removeCicle(Cicle $cicle): self
    {
        $this->cicle->removeElement($cicle);

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
            $practique->setAlumne($this);
        }

        return $this;
    }

    public function removePractique(Practica $practique): self
    {
        if ($this->practiques->removeElement($practique)) {
            // set the owning side to null (unless already changed)
            if ($practique->getAlumne() === $this) {
                $practique->setAlumne(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
