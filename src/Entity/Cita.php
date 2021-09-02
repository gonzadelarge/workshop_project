<?php

namespace App\Entity;

use App\Repository\CitaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CitaRepository::class)
 */
class Cita
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\OneToOne(targetEntity=Mecanico::class, mappedBy="Cod_Cita", cascade={"persist", "remove"})
     */
    private $mecanico;

    /**
     * @ORM\OneToOne(targetEntity=Vehiculo::class, mappedBy="Cod_Cita", cascade={"persist", "remove"})
     */
    private $vehiculo;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="Cod_Cita", cascade={"persist", "remove"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getMecanico(): ?Mecanico
    {
        return $this->mecanico;
    }

    public function setMecanico(?Mecanico $mecanico): self
    {
        // unset the owning side of the relation if necessary
        if ($mecanico === null && $this->mecanico !== null) {
            $this->mecanico->setCodCita(null);
        }

        // set the owning side of the relation if necessary
        if ($mecanico !== null && $mecanico->getCodCita() !== $this) {
            $mecanico->setCodCita($this);
        }

        $this->mecanico = $mecanico;

        return $this;
    }

    public function getVehiculo(): ?Vehiculo
    {
        return $this->vehiculo;
    }

    public function setVehiculo(?Vehiculo $vehiculo): self
    {
        // unset the owning side of the relation if necessary
        if ($vehiculo === null && $this->vehiculo !== null) {
            $this->vehiculo->setCodCita(null);
        }

        // set the owning side of the relation if necessary
        if ($vehiculo !== null && $vehiculo->getCodCita() !== $this) {
            $vehiculo->setCodCita($this);
        }

        $this->vehiculo = $vehiculo;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setCodCita(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getCodCita() !== $this) {
            $user->setCodCita($this);
        }

        $this->user = $user;

        return $this;
    }
}
