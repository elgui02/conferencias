<?php

namespace Umg\ConferenciaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\ConferenciaBundle\Entity;
use Umg\ConferenciaBundle\Entity\ConferenciaAlumno;
use Umg\ConferenciaBundle\Form\ConferenciaAlumnoType;

/**
 * ConferenciaAlumno controller.
 *
 * @Route("/conferenciaalumno")
 */
class ConferenciaAlumnoController extends Controller
{

    /**
     * Lists all ConferenciaAlumno entities.
     *
     * @Route("/", name="conferenciaalumno")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $alumno = $em->getRepository('UmgConferenciaBundle:Alumno')->findOneByUsuario($user);
        $entities = $em->getRepository('UmgConferenciaBundle:Alumno')->findEventoAlumno($alumno->getId());

        return array(
            'entities' => $entities,
            'alumno'   => $alumno,
        );
    }
    
    /**
     * Lists all ConferenciaAlumno entities.
     *
     * @Route("/{id}/evento", name="conferenciaalumno_evento")
     * @Method("GET")
     * @Template()
     */
    public function eventoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $alumno = $em->getRepository('UmgConferenciaBundle:Alumno')->findOneByUsuario($user);
        $evento = $em->getRepository('UmgConferenciaBundle:Evento')->find($id);
        $conf = $em->getRepository('UmgConferenciaBundle:Alumno')->findConferenciaEventoAlumno($alumno->getId(),$id);
        return array(
            'entities' => $evento->getSalons(),
            'evento'   => $evento,
            'mconf'    => $conf,
            'alumno'   => $alumno,
        );
    }

    /**
     * Lists all ConferenciaAlumno entities.
     *
     * @Route("/{id}/apartar", name="conferenciaalumno_apartar")
     * @Method("GET")
     * @Template()
     */
    public function apartarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $alumno = $em->getRepository('UmgConferenciaBundle:Alumno')->findOneByUsuario($user);
        $conf = $em->getRepository('UmgConferenciaBundle:Conferencium')->find($id);
        
        $em->getConnection()->beginTransaction();
         
        try {
            
                $alconf = $em->getRepository('UmgConferenciaBundle:ConferenciaAlumno')->findByConferencium($conf);       
                $ac = new ConferenciaAlumno();
                $ac->setAlumno($alumno);
                $ac->setConferencium($conf);
                $em->persist($ac);
                $em->flush();
             
                $em->getConnection()->commit();
                return $this->redirect($this->generateUrl('conferenciaalumno_evento',array(
                    'id'  => $conf->getEvento()->getId(),
                    )
                ));
        } 
        catch (Exception $e) {
             $em->getConnection()->rollback();
             return $this->redirect($this->generateUrl('conferenciaalumno_evento',array(
                'id'  => $conf->getEvento()->getId(),
                )));
             throw $e;
        }    
    }

    /**
     * Deletes a ConferenciaAlumno entity.
     *
     * @Route("/{id}/delete", name="conferenciaalumno_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('UmgConferenciaBundle:ConferenciaAlumno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ConferenciaAlumno entity.');
        }

        $em->remove($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('conferenciaalumno_evento',array(
                'id'  => $entity->getConferencium()->getEvento()->getId(),
                'ida' => $entity->getAlumno()->getId(),
                )));
    }
}
