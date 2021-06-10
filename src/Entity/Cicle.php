<?php

namespace App\Entity;

use App\Repository\CicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CicleRepository::class)
 */
class Cicle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotNull(message="El nom es obligatori")
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Alumne::class, mappedBy="cicle", cascade={"persist"})
     *
     */
    private $alumnes;

    /**
     * @ORM\OneToMany(targetEntity=Practica::class, mappedBy="cicle")
     *
     */
    private $practiques;

    public function __construct()
    {
        $this->alumnes = new ArrayCollection();
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

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return ArrayCollection|Alumne[]
     */
    public function getAlumnes(): Collection
    {
        return $this->alumnes;
    }

    public function addAlumne(Alumne $alumne): self
    {
        if (!$this->alumnes->contains($alumne)) {
            $this->alumnes[] = $alumne;
            $alumne->addCicle($this);
        }

        return $this;
    }

    public function removeAlumne(Alumne $alumne): self
    {
        if ($this->alumnes->removeElement($alumne)) {
            $alumne->removeCicle($this);
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
            $practique->setCicle($this);
        }

        return $this;
    }

    public function removePractique(Practica $practique): self
    {
        if ($this->practiques->removeElement($practique)) {
            // set the owning side to null (unless already changed)
            if ($practique->getCicle() === $this) {
                $practique->setCicle(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->nom;
    }
}
