<?php

namespace Umg\ConferenciaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\ConferenciaBundle\Entity\AlumnoRecuerdo;
use Umg\ConferenciaBundle\Form\AlumnoRecuerdoType;

/**
 * AlumnoRecuerdo controller.
 *
 * @Route("/alumnorecuerdo")
 */
class AlumnoRecuerdoController extends Controller
{

    /**
     * Lists all AlumnoRecuerdo entities.
     *
     * @Route("/{id}/recuerdos/{ev}", name="alumnorecuerdo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id,$ev)
    {
        $em = $this->getDoctrine()->getManager();
        $evento = $em->getRepository('UmgConferenciaBundle:Evento')->findOneById($ev);
        $recuerdo = $em->getRepository('UmgConferenciaBundle:Recuerdo')->findOneBy(array(
            'evento' => $evento
        ));
        $alumno = $em->getRepository('UmgConferenciaBundle:Alumno')->findOneById($id);
        $entities = $em->getRepository('UmgConferenciaBundle:AlumnoRecuerdo')->findBy(array(
            'recuerdo'=>$recuerdo,
            'alumno'=>$alumno,
        ));

        return array(
            'entities' => $entities,
            'evento' => $evento,
            'alumno' => $alumno,
        );
    }
    /**
     * Creates a new AlumnoRecuerdo entity.
     *
     * @Route("/", name="alumnorecuerdo_create")
     * @Method("POST")
     * @Template("UmgConferenciaBundle:AlumnoRecuerdo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new AlumnoRecuerdo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('alumnorecuerdo', array(
                'id' => $entity->getAlumno()->getId(),
                'ev' => $entity->getRecuerdo()->getEvento()->getId(),
            )));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a AlumnoRecuerdo entity.
     *
     * @param AlumnoRecuerdo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(AlumnoRecuerdo $entity)
    {
        $form = $this->createForm(new AlumnoRecuerdoType(), $entity, array(
            'action' => $this->generateUrl('alumnorecuerdo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AlumnoRecuerdo entity.
     *
     * @Route("/{id}/new/{ev}", name="alumnorecuerdo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id,$ev)
    {
        $em = $this->getDoctrine()->getManager();
        $evento = $em->getRepository('UmgConferenciaBundle:Evento')->findOneById($ev);
        $alumno = $em->getRepository('UmgConferenciaBundle:Alumno')->findOneById($id);
        $entity = new AlumnoRecuerdo();
        $entity->setAlumno($alumno);
        $entity->setFechaHora(new \DateTime());
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AlumnoRecuerdo entity.
     *
     * @Route("/{id}", name="alumnorecuerdo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:AlumnoRecuerdo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AlumnoRecuerdo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AlumnoRecuerdo entity.
     *
     * @Route("/{id}/edit", name="alumnorecuerdo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:AlumnoRecuerdo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AlumnoRecuerdo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a AlumnoRecuerdo entity.
    *
    * @param AlumnoRecuerdo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AlumnoRecuerdo $entity)
    {
        $form = $this->createForm(new AlumnoRecuerdoType(), $entity, array(
            'action' => $this->generateUrl('alumnorecuerdo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AlumnoRecuerdo entity.
     *
     * @Route("/{id}", name="alumnorecuerdo_update")
     * @Method("PUT")
     * @Template("UmgConferenciaBundle:AlumnoRecuerdo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:AlumnoRecuerdo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AlumnoRecuerdo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('alumnorecuerdo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AlumnoRecuerdo entity.
     *
     * @Route("/{id}", name="alumnorecuerdo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UmgConferenciaBundle:AlumnoRecuerdo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AlumnoRecuerdo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('alumnorecuerdo',array(
            'id'=>$entity->getAlumno()->getId(),
            'ev'=>$entity->getRecuerdo()->getEvento()->getId(),
        )));
    }

    /**
     * Creates a form to delete a AlumnoRecuerdo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alumnorecuerdo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
