<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-annotation) on 2015-06-01 17:54:00.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Umg\ConferenciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Umg\ConferenciaBundle\Entity\Evento
 *
 * @ORM\Entity()
 * @ORM\Table(name="Evento")
 */
class Evento
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    protected $Nombre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $FechaInicio;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $FechaFin;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    protected $Lugar;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $Habilitado;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $Direccion;

    /**
     * @ORM\OneToMany(targetEntity="AlumnoEvento", mappedBy="evento")
     * @ORM\JoinColumn(name="id", referencedColumnName="Evento_id")
     */
    protected $alumnoEventos;

    /**
     * @ORM\OneToMany(targetEntity="AlumnoPago", mappedBy="evento")
     * @ORM\JoinColumn(name="id", referencedColumnName="Evento_id")
     */
    protected $alumnoPagos;

    /**
     * @ORM\OneToMany(targetEntity="Conferencium", mappedBy="evento")
     * @ORM\JoinColumn(name="id", referencedColumnName="Evento_id")
     */
    protected $conferencia;

    /**
     * @ORM\OneToMany(targetEntity="Recuerdo", mappedBy="evento")
     * @ORM\JoinColumn(name="id", referencedColumnName="Evento_id")
     */
    protected $recuerdos;

    /**
     * @ORM\OneToMany(targetEntity="Salon", mappedBy="evento")
     * @ORM\JoinColumn(name="id", referencedColumnName="Evento_id")
     */
    protected $salons;

    public function __construct()
    {
        $this->alumnoEventos = new ArrayCollection();
        $this->alumnoPagos = new ArrayCollection();
        $this->conferencia = new ArrayCollection();
        $this->recuerdos = new ArrayCollection();
        $this->salons = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Nombre.
     *
     * @param string $Nombre
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * Get the value of Nombre.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * Set the value of FechaInicio.
     *
     * @param \DateTime $FechaInicio
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function setFechaInicio($FechaInicio)
    {
        $this->FechaInicio = $FechaInicio;

        return $this;
    }

    /**
     * Get the value of FechaInicio.
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->FechaInicio;
    }

    /**
     * Set the value of FechaFin.
     *
     * @param \DateTime $FechaFin
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function setFechaFin($FechaFin)
    {
        $this->FechaFin = $FechaFin;

        return $this;
    }

    /**
     * Get the value of FechaFin.
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->FechaFin;
    }

    /**
     * Set the value of Lugar.
     *
     * @param string $Lugar
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function setLugar($Lugar)
    {
        $this->Lugar = $Lugar;

        return $this;
    }

    /**
     * Get the value of Lugar.
     *
     * @return string
     */
    public function getLugar()
    {
        return $this->Lugar;
    }

    /**
     * Set the value of Habilitado.
     *
     * @param boolean $Habilitado
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function setHabilitado($Habilitado)
    {
        $this->Habilitado = $Habilitado;

        return $this;
    }

    /**
     * Get the value of Habilitado.
     *
     * @return boolean
     */
    public function getHabilitado()
    {
        return $this->Habilitado;
    }

    /**
     * Set the value of Direccion.
     *
     * @param string $Direccion
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function setDireccion($Direccion)
    {
        $this->Direccion = $Direccion;

        return $this;
    }

    /**
     * Get the value of Direccion.
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->Direccion;
    }

    /**
     * Add AlumnoEvento entity to collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\AlumnoEvento $alumnoEvento
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function addAlumnoEvento(AlumnoEvento $alumnoEvento)
    {
        $this->alumnoEventos[] = $alumnoEvento;

        return $this;
    }

    /**
     * Remove AlumnoEvento entity from collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\AlumnoEvento $alumnoEvento
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function removeAlumnoEvento(AlumnoEvento $alumnoEvento)
    {
        $this->alumnoEventos->removeElement($alumnoEvento);

        return $this;
    }

    /**
     * Get AlumnoEvento entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlumnoEventos()
    {
        return $this->alumnoEventos;
    }

    /**
     * Add AlumnoPago entity to collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\AlumnoPago $alumnoPago
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function addAlumnoPago(AlumnoPago $alumnoPago)
    {
        $this->alumnoPagos[] = $alumnoPago;

        return $this;
    }

    /**
     * Remove AlumnoPago entity from collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\AlumnoPago $alumnoPago
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function removeAlumnoPago(AlumnoPago $alumnoPago)
    {
        $this->alumnoPagos->removeElement($alumnoPago);

        return $this;
    }

    /**
     * Get AlumnoPago entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlumnoPagos()
    {
        return $this->alumnoPagos;
    }

    /**
     * Add Conferencium entity to collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\Conferencium $conferencium
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function addConferencium(Conferencium $conferencium)
    {
        $this->conferencia[] = $conferencium;

        return $this;
    }

    /**
     * Remove Conferencium entity from collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\Conferencium $conferencium
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function removeConferencium(Conferencium $conferencium)
    {
        $this->conferencia->removeElement($conferencium);

        return $this;
    }

    /**
     * Get Conferencium entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConferencia()
    {
        return $this->conferencia;
    }

    /**
     * Add Recuerdo entity to collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\Recuerdo $recuerdo
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function addRecuerdo(Recuerdo $recuerdo)
    {
        $this->recuerdos[] = $recuerdo;

        return $this;
    }

    /**
     * Remove Recuerdo entity from collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\Recuerdo $recuerdo
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function removeRecuerdo(Recuerdo $recuerdo)
    {
        $this->recuerdos->removeElement($recuerdo);

        return $this;
    }

    /**
     * Get Recuerdo entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecuerdos()
    {
        return $this->recuerdos;
    }

    /**
     * Add Salon entity to collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\Salon $salon
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function addSalon(Salon $salon)
    {
        $this->salons[] = $salon;

        return $this;
    }

    /**
     * Remove Salon entity from collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\Salon $salon
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function removeSalon(Salon $salon)
    {
        $this->salons->removeElement($salon);

        return $this;
    }

    /**
     * Get Salon entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSalons()
    {
        return $this->salons;
    }

    public function __sleep()
    {
        return array('id', 'Nombre', 'FechaInicio', 'FechaFin', 'Lugar', 'Habilitado', 'Direccion');
    }

    public function __toString()
    {
        return $this->Nombre;
    }
}