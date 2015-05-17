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
}
