<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-annotation) on 2015-05-16 21:38:42.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Umg\ConferenciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Umg\ConferenciaBundle\Entity\AlumnoEvento
 *
 * @ORM\Entity()
 * @ORM\Table(name="AlumnoEvento", indexes={@ORM\Index(name="fk_AlumnoEvento_Alumno1_idx", columns={"Alumno_id"}), @ORM\Index(name="fk_AlumnoEvento_Evento1_idx", columns={"Evento_id"})})
 */
class AlumnoEvento
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $Alumno_id;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $Evento_id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $Pagado;

    /**
     * @ORM\ManyToOne(targetEntity="Alumno", inversedBy="alumnoEventos")
     * @ORM\JoinColumn(name="Alumno_id", referencedColumnName="id")
     */
    protected $alumno;

    /**
     * @ORM\ManyToOne(targetEntity="Evento", inversedBy="alumnoEventos")
     * @ORM\JoinColumn(name="Evento_id", referencedColumnName="id")
     */
    protected $evento;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Umg\ConferenciaBundle\Entity\AlumnoEvento
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
     * Set the value of Alumno_id.
     *
     * @param integer $Alumno_id
     * @return \Umg\ConferenciaBundle\Entity\AlumnoEvento
     */
    public function setAlumnoId($Alumno_id)
    {
        $this->Alumno_id = $Alumno_id;

        return $this;
    }

    /**
     * Get the value of Alumno_id.
     *
     * @return integer
     */
    public function getAlumnoId()
    {
        return $this->Alumno_id;
    }

    /**
     * Set the value of Evento_id.
     *
     * @param integer $Evento_id
     * @return \Umg\ConferenciaBundle\Entity\AlumnoEvento
     */
    public function setEventoId($Evento_id)
    {
        $this->Evento_id = $Evento_id;

        return $this;
    }

    /**
     * Get the value of Evento_id.
     *
     * @return integer
     */
    public function getEventoId()
    {
        return $this->Evento_id;
    }

    /**
     * Set the value of Pagado.
     *
     * @param boolean $Pagado
     * @return \Umg\ConferenciaBundle\Entity\AlumnoEvento
     */
    public function setPagado($Pagado)
    {
        $this->Pagado = $Pagado;

        return $this;
    }

    /**
     * Get the value of Pagado.
     *
     * @return boolean
     */
    public function getPagado()
    {
        return $this->Pagado;
    }

    /**
     * Set Alumno entity (many to one).
     *
     * @param \Umg\ConferenciaBundle\Entity\Alumno $alumno
     * @return \Umg\ConferenciaBundle\Entity\AlumnoEvento
     */
    public function setAlumno(Alumno $alumno = null)
    {
        $this->alumno = $alumno;

        return $this;
    }

    /**
     * Get Alumno entity (many to one).
     *
     * @return \Umg\ConferenciaBundle\Entity\Alumno
     */
    public function getAlumno()
    {
        return $this->alumno;
    }

    /**
     * Set Evento entity (many to one).
     *
     * @param \Umg\ConferenciaBundle\Entity\Evento $evento
     * @return \Umg\ConferenciaBundle\Entity\AlumnoEvento
     */
    public function setEvento(Evento $evento = null)
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * Get Evento entity (many to one).
     *
     * @return \Umg\ConferenciaBundle\Entity\Evento
     */
    public function getEvento()
    {
        return $this->evento;
    }

    public function __sleep()
    {
        return array('id', 'Alumno_id', 'Evento_id', 'Pagado');
    }
}