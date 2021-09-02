<?php

namespace App\Entity;

use App\Repository\MecanicoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MecanicoRepository::class)
 */
class Mecanico
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $DNI;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     */
    private $salario;

    /**
     * @ORM\Column(type="integer")
     */
    private $horas;

    /**
     * @ORM\OneToOne(targetEntity=Cita::class, inversedBy="mecanico", cascade={"persist", "remove"})
     */
    private $Cod_Cita;

    /**
     * @ORM\ManyToOne(targetEntity=Vehiculo::class, inversedBy="mecanico")
     */
    private $Cod_Vehiculo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDNI(): ?string
    {
        return $this->DNI;
    }

    public function setDNI(string $DNI): self
    {
        $this->DNI = $DNI;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getSalario(): ?int
    {
        return $this->salario;
    }

    public function setSalario(int $salario): self
    {
        $this->salario = $salario;

        return $this;
    }

    public function getHoras(): ?int
    {
        return $this->horas;
    }

    public function setHoras(int $horas): self
    {
        $this->horas = $horas;

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

    public function getCodVehiculo(): ?Vehiculo
    {
        return $this->Cod_Vehiculo;
    }

    public function setCodVehiculo(?Vehiculo $Cod_Vehiculo): self
    {
        $this->Cod_Vehiculo = $Cod_Vehiculo;

        return $this;
    }
}
