<?php

namespace Umg\ConferenciaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\ConferenciaBundle\Entity\Recuerdo;
use Umg\ConferenciaBundle\Form\RecuerdoType;

/**
 * Recuerdo controller.
 *
 * @Route("/recuerdo")
 */
class RecuerdoController extends Controller
{

    /**
     * Lists all Recuerdo entities.
     *
     * @Route("/", name="recuerdo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UmgConferenciaBundle:Recuerdo')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Recuerdo entity.
     *
     * @Route("/", name="recuerdo_create")
     * @Method("POST")
     * @Template("UmgConferenciaBundle:Recuerdo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Recuerdo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evento_show', array('id' => $entity->getEvento()->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Recuerdo entity.
     *
     * @param Recuerdo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Recuerdo $entity)
    {
        $form = $this->createForm(new RecuerdoType(), $entity, array(
            'action' => $this->generateUrl('recuerdo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Recuerdo entity.
     *
     * @Route("/{id}/new", name="recuerdo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $evento = $em->getRepository('UmgConferenciaBundle:Evento')->find($id);
        $entity = new Recuerdo();
        $entity->setEvento($evento);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Recuerdo entity.
     *
     * @Route("/{id}", name="recuerdo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Recuerdo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recuerdo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Recuerdo entity.
     *
     * @Route("/{id}/edit", name="recuerdo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Recuerdo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recuerdo entity.');
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
    * Creates a form to edit a Recuerdo entity.
    *
    * @param Recuerdo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Recuerdo $entity)
    {
        $form = $this->createForm(new RecuerdoType(), $entity, array(
            'action' => $this->generateUrl('recuerdo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Recuerdo entity.
     *
     * @Route("/{id}", name="recuerdo_update")
     * @Method("PUT")
     * @Template("UmgConferenciaBundle:Recuerdo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Recuerdo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recuerdo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('recuerdo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Recuerdo entity.
     *
     * @Route("/{id}", name="recuerdo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UmgConferenciaBundle:Recuerdo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Recuerdo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('recuerdo'));
    }

    /**
     * Creates a form to delete a Recuerdo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('recuerdo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
