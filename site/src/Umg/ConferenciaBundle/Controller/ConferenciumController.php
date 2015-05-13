<?php

namespace Umg\ConferenciaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\ConferenciaBundle\Entity\Conferencium;
use Umg\ConferenciaBundle\Form\ConferenciumType;

/**
 * Conferencium controller.
 *
 * @Route("/conferencia")
 */
class ConferenciumController extends Controller
{

    /**
     * Lists all Conferencium entities.
     *
     * @Route("/", name="conferencia")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UmgConferenciaBundle:Conferencium')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Conferencium entity.
     *
     * @Route("/", name="conferencia_create")
     * @Method("POST")
     * @Template("UmgConferenciaBundle:Conferencium:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Conferencium();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('conferencia_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Conferencium entity.
     *
     * @param Conferencium $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Conferencium $entity)
    {
        $form = $this->createForm(new ConferenciumType(), $entity, array(
            'action' => $this->generateUrl('conferencia_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Conferencium entity.
     *
     * @Route("/new", name="conferencia_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Conferencium();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Conferencium entity.
     *
     * @Route("/{id}", name="conferencia_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Conferencium')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conferencium entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Conferencium entity.
     *
     * @Route("/{id}/edit", name="conferencia_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Conferencium')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conferencium entity.');
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
    * Creates a form to edit a Conferencium entity.
    *
    * @param Conferencium $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Conferencium $entity)
    {
        $form = $this->createForm(new ConferenciumType(), $entity, array(
            'action' => $this->generateUrl('conferencia_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Conferencium entity.
     *
     * @Route("/{id}", name="conferencia_update")
     * @Method("PUT")
     * @Template("UmgConferenciaBundle:Conferencium:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Conferencium')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conferencium entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('conferencia_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Conferencium entity.
     *
     * @Route("/{id}", name="conferencia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UmgConferenciaBundle:Conferencium')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Conferencium entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('conferencia'));
    }

    /**
     * Creates a form to delete a Conferencium entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('conferencia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
