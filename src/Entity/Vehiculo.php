<?php

namespace App\Entity;

use App\Repository\VehiculoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehiculoRepository::class)
 */
class Vehiculo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $Matricula;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Marca;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $Modelo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Image;

    /**
     * @ORM\OneToMany(targetEntity=Mecanico::class, mappedBy="Cod_Vehiculo")
     */
    private $mecanico;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="vehiculos")
     */
    private $Cod_User;

    /**
     * @ORM\OneToOne(targetEntity=Cita::class, inversedBy="vehiculo", cascade={"persist", "remove"})
     */
    private $Cod_Cita;

    public function __construct()
    {
        $this->mecanico = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricula(): ?string
    {
        return $this->Matricula;
    }

    public function setMatricula(string $Matricula): self
    {
        $this->Matricula = $Matricula;

        return $this;
    }

    public function getMarca(): ?string
    {
        return $this->Marca;
    }

    public function setMarca(string $Marca): self
    {
        $this->Marca = $Marca;

        return $this;
    }

    public function getModelo(): ?string
    {
        return $this->Modelo;
    }

    public function setModelo(?string $Modelo): self
    {
        $this->Modelo = $Modelo;

        return $this;
    }

    public function getYear(): ?\DateTimeInterface
    {
        return $this->Year;
    }

    public function setYear(?\DateTimeInterface $Year): self
    {
        $this->Year = $Year;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    /**
     * @return Collection|Mecanico[]
     */
    public function getMecanico(): Collection
    {
        return $this->mecanico;
    }

    public function addMecanico(Mecanico $mecanico): self
    {
        if (!$this->mecanico->contains($mecanico)) {
            $this->mecanico[] = $mecanico;
            $mecanico->setCodVehiculo($this);
        }

        return $this;
    }

    public function removeMecanico(Mecanico $mecanico): self
    {
        if ($this->mecanico->removeElement($mecanico)) {
            // set the owning side to null (unless already changed)
            if ($mecanico->getCodVehiculo() === $this) {
                $mecanico->setCodVehiculo(null);
            }
        }

        return $this;
    }

    public function getCodUser(): ?User
    {
        return $this->Cod_User;
    }

    public function setCodUser(?User $Cod_User): self
    {
        $this->Cod_User = $Cod_User;

        return $this;
    }

    public function getCodCita(): ?Cita
    {
        return $this->Cod_Cita;
    }

    public function setCodCita(?Cita $Cod_Cita): self
    {
        $this->Cod_Cita = $Cod_Cita;

        return $this;
    }
}
