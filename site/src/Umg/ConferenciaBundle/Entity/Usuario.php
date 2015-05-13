<?php
// src/Acme/UserBundle/Entity/User.php

namespace Umg\ConferenciaBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario")
 */
class Usuario extends BaseUser
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
    protected $Nombre;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    protected $Puesto;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $FechaNacimiento;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $Sexo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $EstadoCivil;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $TelCasa;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $TelCelular;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $Direccion;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $Foto;

    /**
     * @ORM\ManyToMany(targetEntity="Umg\ConferenciaBundle\Entity\Grupo")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}