<?php
namespace Umg\ConferenciaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ConferencistaRepository extends EntityRepository
{
	public function findViaticosSinPagar($evento)   
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM UmgConferenciaBundle:Conferencistum c INNER JOIN c.conferencia cc INNER JOIN cc.evento e WHERE e.id = :evento AND cc.Pagado IS NULL GROUP BY c.id'
            )
            ->setParameter('evento',$evento)
            ->getResult();
    }

    public function findViaticosPagados($evento)   
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM UmgConferenciaBundle:Conferencistum c INNER JOIN c.conferencia cc INNER JOIN cc.evento e WHERE e.id = :evento AND cc.Pagado = TRUE GROUP BY c.id'
            )
            ->setParameter('evento',$evento)
            ->getResult();
    }
}