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
 * Umg\ConferenciaBundle\Entity\Recuerdo
 *
 * @ORM\Entity()
 * @ORM\Table(name="Recuerdo")
 */
class Recuerdo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    protected $Recuerdo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $Observaciones;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $Cantidad;

    /**
     * @ORM\OneToMany(targetEntity="AlumnoRecuerdo", mappedBy="recuerdo")
     * @ORM\JoinColumn(name="id", referencedColumnName="Recuerdo_id")
     */
    protected $alumnoRecuerdos;

    public function __construct()
    {
        $this->alumnoRecuerdos = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Umg\ConferenciaBundle\Entity\Recuerdo
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
     * Set the value of Recuerdo.
     *
     * @param string $Recuerdo
     * @return \Umg\ConferenciaBundle\Entity\Recuerdo
     */
    public function setRecuerdo($Recuerdo)
    {
        $this->Recuerdo = $Recuerdo;

        return $this;
    }

    /**
     * Get the value of Recuerdo.
     *
     * @return string
     */
    public function getRecuerdo()
    {
        return $this->Recuerdo;
    }

    /**
     * Set the value of Observaciones.
     *
     * @param string $Observaciones
     * @return \Umg\ConferenciaBundle\Entity\Recuerdo
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
     * Set the value of Cantidad.
     *
     * @param integer $Cantidad
     * @return \Umg\ConferenciaBundle\Entity\Recuerdo
     */
    public function setCantidad($Cantidad)
    {
        $this->Cantidad = $Cantidad;

        return $this;
    }

    /**
     * Get the value of Cantidad.
     *
     * @return integer
     */
    public function getCantidad()
    {
        return $this->Cantidad;
    }

    /**
     * Add AlumnoRecuerdo entity to collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\AlumnoRecuerdo $alumnoRecuerdo
     * @return \Umg\ConferenciaBundle\Entity\Recuerdo
     */
    public function addAlumnoRecuerdo(AlumnoRecuerdo $alumnoRecuerdo)
    {
        $this->alumnoRecuerdos[] = $alumnoRecuerdo;

        return $this;
    }

    /**
     * Remove AlumnoRecuerdo entity from collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\AlumnoRecuerdo $alumnoRecuerdo
     * @return \Umg\ConferenciaBundle\Entity\Recuerdo
     */
    public function removeAlumnoRecuerdo(AlumnoRecuerdo $alumnoRecuerdo)
    {
        $this->alumnoRecuerdos->removeElement($alumnoRecuerdo);

        return $this;
    }

    /**
     * Get AlumnoRecuerdo entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlumnoRecuerdos()
    {
        return $this->alumnoRecuerdos;
    }

    public function __sleep()
    {
        return array('id', 'Recuerdo', 'Observaciones', 'Cantidad');
    }
}