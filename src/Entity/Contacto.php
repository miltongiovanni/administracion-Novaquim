<?php

namespace App\Entity;

use App\Repository\ContactoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactoRepository::class)
 */
class Contacto
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
    private $nombreContacto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $organizacion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailContacto;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $celular;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tipoConsulta;

    /**
     * @ORM\Column(type="text")
     */
    private $mensaje;

    /**
     * @ORM\Column(type="integer")
     */
    private $aceptaPolitica;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha_contacto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreContacto(): ?string
    {
        return $this->nombreContacto;
    }

    public function setNombreContacto(string $nombreContacto): self
    {
        $this->nombreContacto = $nombreContacto;

        return $this;
    }

    public function getOrganizacion(): ?string
    {
        return $this->organizacion;
    }

    public function setOrganizacion(string $organizacion): self
    {
        $this->organizacion = $organizacion;

        return $this;
    }

    public function getEmailContacto(): ?string
    {
        return $this->emailContacto;
    }

    public function setEmailContacto(string $emailContacto): self
    {
        $this->emailContacto = $emailContacto;

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

    public function setCelular(?string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    public function getTipoConsulta(): ?string
    {
        return $this->tipoConsulta;
    }

    public function setTipoConsulta(string $tipoConsulta): self
    {
        $this->tipoConsulta = $tipoConsulta;

        return $this;
    }

    public function getMensaje(): ?string
    {
        return $this->mensaje;
    }

    public function setMensaje(string $mensaje): self
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    public function getAceptaPolitica(): ?int
    {
        return $this->aceptaPolitica;
    }

    public function setAceptaPolitica(int $aceptaPolitica): self
    {
        $this->aceptaPolitica = $aceptaPolitica;

        return $this;
    }

    public function getFechaContacto(): ?\DateTimeInterface
    {
        return $this->fecha_contacto;
    }

    public function setFechaContacto(?\DateTimeInterface $fecha_contacto): self
    {
        $this->fecha_contacto = $fecha_contacto;

        return $this;
    }
}
