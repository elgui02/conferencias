<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-annotation) on 2015-05-16 11:57:28.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Umg\ConferenciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Umg\ConferenciaBundle\Entity\ConferenciaAlumno
 *
 * @ORM\Entity()
 * @ORM\Table(name="ConferenciaAlumno", indexes={@ORM\Index(name="fk_ConferenciaAlumno_Alumno1_idx", columns={"Alumno_id"}), @ORM\Index(name="fk_ConferenciaAlumno_Conferencia1_idx", columns={"Conferencia_id"})})
 */
class ConferenciaAlumno
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
    protected $Conferencia_id;

    /**
     * @ORM\ManyToOne(targetEntity="Alumno", inversedBy="conferenciaAlumnos")
     * @ORM\JoinColumn(name="Alumno_id", referencedColumnName="id")
     */
    protected $alumno;

    /**
     * @ORM\ManyToOne(targetEntity="Conferencium", inversedBy="conferenciaAlumnos")
     * @ORM\JoinColumn(name="Conferencia_id", referencedColumnName="id")
     */
    protected $conferencium;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Umg\ConferenciaBundle\Entity\ConferenciaAlumno
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
     * @return \Umg\ConferenciaBundle\Entity\ConferenciaAlumno
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
     * Set the value of Conferencia_id.
     *
     * @param integer $Conferencia_id
     * @return \Umg\ConferenciaBundle\Entity\ConferenciaAlumno
     */
    public function setConferenciaId($Conferencia_id)
    {
        $this->Conferencia_id = $Conferencia_id;

        return $this;
    }

    /**
     * Get the value of Conferencia_id.
     *
     * @return integer
     */
    public function getConferenciaId()
    {
        return $this->Conferencia_id;
    }

    /**
     * Set Alumno entity (many to one).
     *
     * @param \Umg\ConferenciaBundle\Entity\Alumno $alumno
     * @return \Umg\ConferenciaBundle\Entity\ConferenciaAlumno
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
     * Set Conferencium entity (many to one).
     *
     * @param \Umg\ConferenciaBundle\Entity\Conferencium $conferencium
     * @return \Umg\ConferenciaBundle\Entity\ConferenciaAlumno
     */
    public function setConferencium(Conferencium $conferencium = null)
    {
        $this->conferencium = $conferencium;

        return $this;
    }

    /**
     * Get Conferencium entity (many to one).
     *
     * @return \Umg\ConferenciaBundle\Entity\Conferencium
     */
    public function getConferencium()
    {
        return $this->conferencium;
    }

    public function __sleep()
    {
        return array('id', 'Alumno_id', 'Conferencia_id');
    }
}