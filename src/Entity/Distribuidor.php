<?php

namespace App\Entity;

use App\Repository\DistribuidorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DistribuidorRepository::class)
 */
class Distribuidor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $distribuidor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contacto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $celular;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $direccion;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     */
    private $longitud;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     */
    private $latitud;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistribuidor(): ?string
    {
        return $this->distribuidor;
    }

    public function setDistribuidor(string $distribuidor): self
    {
        $this->distribuidor = $distribuidor;

        return $this;
    }

    public function getContacto(): ?string
    {
        return $this->contacto;
    }

    public function setContacto(string $contacto): self
    {
        $this->contacto = $contacto;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getLongitud(): ?string
    {
        return $this->longitud;
    }

    public function setLongitud(string $longitud): self
    {
        $this->longitud = $longitud;

        return $this;
    }

    public function getLatitud(): ?string
    {
        return $this->latitud;
    }

    public function setLatitud(string $latitud): self
    {
        $this->latitud = $latitud;

        return $this;
    }

    public function isEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
