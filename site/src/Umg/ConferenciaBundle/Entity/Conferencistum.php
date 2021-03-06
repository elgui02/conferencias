<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-annotation) on 2015-05-16 11:57:28.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Umg\ConferenciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Umg\ConferenciaBundle\Entity\Conferencistum
 *
 * @ORM\Entity(repositoryClass="Umg\ConferenciaBundle\Entity\ConferencistaRepository")
 * @ORM\Table(name="Conferencista")
 */
class Conferencistum
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
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    protected $Correo;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $Telefono;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $Observaciones;

    /**
     * @ORM\OneToMany(targetEntity="Conferencium", mappedBy="conferencistum")
     * @ORM\JoinColumn(name="id", referencedColumnName="Conferencista_id")
     */
    protected $conferencia;

    /**
     * @ORM\OneToMany(targetEntity="Pago", mappedBy="conferencistum")
     * @ORM\JoinColumn(name="id", referencedColumnName="Conferencista_id")
     */
    protected $pagos;

    public function __construct()
    {
        $this->conferencia = new ArrayCollection();
        $this->pagos = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Umg\ConferenciaBundle\Entity\Conferencistum
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
     * @return \Umg\ConferenciaBundle\Entity\Conferencistum
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
     * Set the value of Correo.
     *
     * @param string $Correo
     * @return \Umg\ConferenciaBundle\Entity\Conferencistum
     */
    public function setCorreo($Correo)
    {
        $this->Correo = $Correo;

        return $this;
    }

    /**
     * Get the value of Correo.
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->Correo;
    }

    /**
     * Set the value of Telefono.
     *
     * @param string $Telefono
     * @return \Umg\ConferenciaBundle\Entity\Conferencistum
     */
    public function setTelefono($Telefono)
    {
        $this->Telefono = $Telefono;

        return $this;
    }

    /**
     * Get the value of Telefono.
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->Telefono;
    }

    /**
     * Set the value of Observaciones.
     *
     * @param string $Observaciones
     * @return \Umg\ConferenciaBundle\Entity\Conferencistum
     */
    public function setObservaciones($Observaciones)
    {
        $this->Observaciones = $Observaciones;

        return $this;
    }

    /**
     * Get the value of Observaciones.
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->Observaciones;
    }

    /**
     * Add Conferencium entity to collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\Conferencium $conferencium
     * @return \Umg\ConferenciaBundle\Entity\Conferencistum
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
     * @return \Umg\ConferenciaBundle\Entity\Conferencistum
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
     * Add Pago entity to collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\Pago $pago
     * @return \Umg\ConferenciaBundle\Entity\Conferencistum
     */
    public function addPago(Pago $pago)
    {
        $this->pagos[] = $pago;

        return $this;
    }

    /**
     * Remove Pago entity from collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\Pago $pago
     * @return \Umg\ConferenciaBundle\Entity\Conferencistum
     */
    public function removePago(Pago $pago)
    {
        $this->pagos->removeElement($pago);

        return $this;
    }

    /**
     * Get Pago entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPagos()
    {
        return $this->pagos;
    }

    public function __sleep()
    {
        return array('id', 'Nombre', 'Correo', 'Telefono', 'Observaciones');
    }

    public function __toString()
    {
        return $this->Nombre;
    }
}
