<?php

namespace App\Entity;

use App\Repository\PracticaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PracticaRepository::class)
 */
class Practica
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotNull(message="El periode es obligatori")
     */
    private $periode;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotNull(message="La data es obligatoria")
     */
    private $data;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observacions;

    /**
     * @ORM\ManyToOne(targetEntity=Alumne::class, inversedBy="practiques")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull(message="L'alumne es obligatori")
     */
    private $alumne;

    /**
     * @ORM\ManyToOne(targetEntity=Empresa::class, inversedBy="practiques")
     * @Assert\NotNull(message="L'empresa es obligatoria")
     */
    private $empresa;

    /**
     * @ORM\OneToMany(targetEntity=Accio::class, mappedBy="practica")
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

    public function getPeriode(): ?string
    {
        return $this->periode;
    }

    public function setPeriode(?string $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData(?\DateTimeInterface $data): void
    {
        $this->data = $data;
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

    public function getAlumne(): ?Alumne
    {
        return $this->alumne;
    }

    public function setAlumne(?Alumne $alumne): self
    {
        $this->alumne = $alumne;

        return $this;
    }

    public function getCicle(): ?Cicle
    {
        return $this->cicle;
    }

    public function setCicle(?Cicle $cicle): self
    {
        $this->cicle = $cicle;

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
            $accion->setPractica($this);
        }

        return $this;
    }

    public function removeAccion(Accio $accion): self
    {
        if ($this->accions->removeElement($accion)) {
            // set the owning side to null (unless already changed)
            if ($accion->getPractica() === $this) {
                $accion->setPractica(null);
            }
        }

        return $this;
    }
}
