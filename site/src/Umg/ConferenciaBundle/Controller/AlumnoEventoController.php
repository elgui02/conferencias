<?php

namespace Umg\ConferenciaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\ConferenciaBundle\Entity\AlumnoEvento;
use Umg\ConferenciaBundle\Form\AlumnoEventoType;

/**
 * AlumnoEvento controller.
 *
 * @Route("/alumnoevento")
 */
class AlumnoEventoController extends Controller
{

    /**
     * Lists all AlumnoEvento entities.
     *
     * @Route("/{id}", name="alumnoevento")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $ev = $em->getRepository('UmgConferenciaBundle:Evento')->find($id);
        $entities = $em->getRepository('UmgConferenciaBundle:AlumnoEvento')->findBy(array('evento'=>$ev));

        return array(
            'evento'   => $ev,
            'entities' => $entities,
        );
    }
    /**
     * Creates a new AlumnoEvento entity.
     *
     * @Route("/", name="alumnoevento_create")
     * @Method("POST")
     * @Template("UmgConferenciaBundle:AlumnoEvento:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new AlumnoEvento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('alumnoevento', array('id' => $entity->getEvento()->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a AlumnoEvento entity.
     *
     * @param AlumnoEvento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(AlumnoEvento $entity)
    {
        $form = $this->createForm(new AlumnoEventoType(), $entity, array(
            'action' => $this->generateUrl('alumnoevento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AlumnoEvento entity.
     *
     * @Route("/{id}/new", name="alumnoevento_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('UmgConferenciaBundle:Evento')->find($id);
        $entity = new AlumnoEvento();
        $entity->setEvento($ev);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AlumnoEvento entity.
     *
     * @Route("/{id}", name="alumnoevento_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:AlumnoEvento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AlumnoEvento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AlumnoEvento entity.
     *
     * @Route("/{id}/edit", name="alumnoevento_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:AlumnoEvento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AlumnoEvento entity.');
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
    * Creates a form to edit a AlumnoEvento entity.
    *
    * @param AlumnoEvento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AlumnoEvento $entity)
    {
        $form = $this->createForm(new AlumnoEventoType(), $entity, array(
            'action' => $this->generateUrl('alumnoevento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AlumnoEvento entity.
     *
     * @Route("/{id}", name="alumnoevento_update")
     * @Method("PUT")
     * @Template("UmgConferenciaBundle:AlumnoEvento:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:AlumnoEvento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AlumnoEvento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('alumnoevento_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AlumnoEvento entity.
     *
     * @Route("/{id}/borrar", name="alumnoevento_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('UmgConferenciaBundle:AlumnoEvento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AlumnoEvento entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('alumnoevento',array(
            'id' => $entity->getEvento()->getId(),
        )));
    }

    /**
     * Creates a form to delete a AlumnoEvento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alumnoevento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
