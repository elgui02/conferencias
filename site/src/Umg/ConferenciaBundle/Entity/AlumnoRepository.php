<?php
namespace Umg\ConferenciaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AlumnoRepository extends EntityRepository
{
    public function findAlumnosSinPagar($evento)   
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a FROM UmgConferenciaBundle:Alumno a INNER JOIN a.alumnoEventos ae INNER JOIN ae.evento e WHERE a.id NOT IN ( SELECT ap.Alumno_id From UmgConferenciaBundle:AlumnoPago ap where ap.Alumno_id=a.id AND ap.Evento_id = e.id ) AND e.id = :evento'
            )
            ->setParameter('evento',$evento)
            ->getResult();
    }

    public function findEventoAlumno($alumno)
    {
    	return $this->getEntityManager()
            ->createQuery(
            	'SELECT e FROM UmgConferenciaBundle:Evento e INNER JOIN e.alumnoPagos ap
            	WHERE ap.Alumno_id = :alumno and e.FechaInicio >= :fecha'
            	)
            ->setParameter('alumno',$alumno)
            ->setParameter('fecha','NOW()')
            ->getResult();
    }

    public function findConferenciaEventoAlumno($alumno,$evento)
    {
    	return $this->getEntityManager()
            ->createQuery(
            	'SELECT ca FROM UmgConferenciaBundle:ConferenciaAlumno ca 
            	INNER JOIN ca.conferencium c
            	INNER JOIN c.evento e
            	WHERE ca.Alumno_id = :alumno and e.id = :evento'
            	)
            ->setParameter('alumno',$alumno)
            ->setParameter('evento',$evento)
            ->getResult();
    }

    public function findRecuerdos($alumno, $evento)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT r FROM UmgConferenciaBundle:Recuerdo r
                WHERE r.Alumno_id = :alumno and e.Evento_id = :evento'
                )
            ->setParameter('alumno',$alumno)
            ->setParameter('evento',$evento)
            ->getResult();
    }
}
