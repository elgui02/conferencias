<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-annotation) on 2015-04-27 18:40:59.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Umg\ConferenciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Umg\ConferenciaBundle\Entity\Conferencium
 *
 * @ORM\Entity()
 * @ORM\Table(name="Conferencia", indexes={@ORM\Index(name="fk_Conferencia_Conferencista_idx", columns={"Conferencista_id"}), @ORM\Index(name="fk_Conferencia_Salon1_idx", columns={"Salon_id"})})
 */
class Conferencium
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
    protected $Conferencia;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $HoraInicio;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $HoraFIn;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $Conferencista_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $Salon_id;

    /**
     * @ORM\OneToMany(targetEntity="ConferenciaAlumno", mappedBy="conferencium")
     * @ORM\JoinColumn(name="id", referencedColumnName="Conferencia_id")
     */
    protected $conferenciaAlumnos;

    /**
     * @ORM\ManyToOne(targetEntity="Conferencistum", inversedBy="conferencia")
     * @ORM\JoinColumn(name="Conferencista_id", referencedColumnName="id")
     */
    protected $conferencistum;

    /**
     * @ORM\ManyToOne(targetEntity="Salon", inversedBy="conferencia")
     * @ORM\JoinColumn(name="Salon_id", referencedColumnName="id")
     */
    protected $salon;

    public function __construct()
    {
        $this->conferenciaAlumnos = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Umg\ConferenciaBundle\Entity\Conferencium
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
     * Set the value of Conferencia.
     *
     * @param string $Conferencia
     * @return \Umg\ConferenciaBundle\Entity\Conferencium
     */
    public function setConferencia($Conferencia)
    {
        $this->Conferencia = $Conferencia;

        return $this;
    }

    /**
     * Get the value of Conferencia.
     *
     * @return string
     */
    public function getConferencia()
    {
        return $this->Conferencia;
    }

    /**
     * Set the value of HoraInicio.
     *
     * @param datetime $HoraInicio
     * @return \Umg\ConferenciaBundle\Entity\Conferencium
     */
    public function setHoraInicio($HoraInicio)
    {
        $this->HoraInicio = $HoraInicio;

        return $this;
    }

    /**
     * Get the value of HoraInicio.
     *
     * @return datetime
     */
    public function getHoraInicio()
    {
        return $this->HoraInicio;
    }

    /**
     * Set the value of HoraFIn.
     *
     * @param datetime $HoraFIn
     * @return \Umg\ConferenciaBundle\Entity\Conferencium
     */
    public function setHoraFIn($HoraFIn)
    {
        $this->HoraFIn = $HoraFIn;

        return $this;
    }

    /**
     * Get the value of HoraFIn.
     *
     * @return datetime
     */
    public function getHoraFIn()
    {
        return $this->HoraFIn;
    }

    /**
     * Set the value of Conferencista_id.
     *
     * @param integer $Conferencista_id
     * @return \Umg\ConferenciaBundle\Entity\Conferencium
     */
    public function setConferencistaId($Conferencista_id)
    {
        $this->Conferencista_id = $Conferencista_id;

        return $this;
    }

    /**
     * Get the value of Conferencista_id.
     *
     * @return integer
     */
    public function getConferencistaId()
    {
        return $this->Conferencista_id;
    }

    /**
     * Set the value of Salon_id.
     *
     * @param integer $Salon_id
     * @return \Umg\ConferenciaBundle\Entity\Conferencium
     */
    public function setSalonId($Salon_id)
    {
        $this->Salon_id = $Salon_id;

        return $this;
    }

    /**
     * Get the value of Salon_id.
     *
     * @return integer
     */
    public function getSalonId()
    {
        return $this->Salon_id;
    }

    /**
     * Add ConferenciaAlumno entity to collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\ConferenciaAlumno $conferenciaAlumno
     * @return \Umg\ConferenciaBundle\Entity\Conferencium
     */
    public function addConferenciaAlumno(ConferenciaAlumno $conferenciaAlumno)
    {
        $this->conferenciaAlumnos[] = $conferenciaAlumno;

        return $this;
    }

    /**
     * Remove ConferenciaAlumno entity from collection (one to many).
     *
     * @param \Umg\ConferenciaBundle\Entity\ConferenciaAlumno $conferenciaAlumno
     * @return \Umg\ConferenciaBundle\Entity\Conferencium
     */
    public function removeConferenciaAlumno(ConferenciaAlumno $conferenciaAlumno)
    {
        $this->conferenciaAlumnos->removeElement($conferenciaAlumno);

        return $this;
    }

    /**
     * Get ConferenciaAlumno entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConferenciaAlumnos()
    {
        return $this->conferenciaAlumnos;
    }

    /**
     * Set Conferencistum entity (many to one).
     *
     * @param \Umg\ConferenciaBundle\Entity\Conferencistum $conferencistum
     * @return \Umg\ConferenciaBundle\Entity\Conferencium
     */
    public function setConferencistum(Conferencistum $conferencistum = null)
    {
        $this->conferencistum = $conferencistum;

        return $this;
    }

    /**
     * Get Conferencistum entity (many to one).
     *
     * @return \Umg\ConferenciaBundle\Entity\Conferencistum
     */
    public function getConferencistum()
    {
        return $this->conferencistum;
    }

    /**
     * Set Salon entity (many to one).
     *
     * @param \Umg\ConferenciaBundle\Entity\Salon $salon
     * @return \Umg\ConferenciaBundle\Entity\Conferencium
     */
    public function setSalon(Salon $salon = null)
    {
        $this->salon = $salon;

        return $this;
    }

    /**
     * Get Salon entity (many to one).
     *
     * @return \Umg\ConferenciaBundle\Entity\Salon
     */
    public function getSalon()
    {
        return $this->salon;
    }

    public function __sleep()
    {
        return array('id', 'Conferencia', 'HoraInicio', 'HoraFIn', 'Conferencista_id', 'Salon_id');
    }
}