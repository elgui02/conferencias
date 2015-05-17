<?php

namespace Umg\ConferenciaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\ConferenciaBundle\Entity\Salon;
use Umg\ConferenciaBundle\Form\SalonType;

/**
 * Salon controller.
 *
 * @Route("/salon")
 */
class SalonController extends Controller
{

    /**
     * Lists all Salon entities.
     *
     * @Route("/", name="salon")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UmgConferenciaBundle:Salon')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Salon entity.
     *
     * @Route("/", name="salon_create")
     * @Method("POST")
     * @Template("UmgConferenciaBundle:Salon:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Salon();
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
     * Creates a form to create a Salon entity.
     *
     * @param Salon $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Salon $entity)
    {
        $form = $this->createForm(new SalonType(), $entity, array(
            'action' => $this->generateUrl('salon_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Salon entity.
     *
     * @Route("/{id}/new", name="salon_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('UmgConferenciaBundle:Evento')->find($id);

        $entity = new Salon();
        $entity->setEvento($ev);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Salon entity.
     *
     * @Route("/{id}", name="salon_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Salon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Salon entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Salon entity.
     *
     * @Route("/{id}/edit", name="salon_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Salon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Salon entity.');
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
    * Creates a form to edit a Salon entity.
    *
    * @param Salon $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Salon $entity)
    {
        $form = $this->createForm(new SalonType(), $entity, array(
            'action' => $this->generateUrl('salon_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Salon entity.
     *
     * @Route("/{id}", name="salon_update")
     * @Method("PUT")
     * @Template("UmgConferenciaBundle:Salon:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Salon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Salon entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('salon_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Salon entity.
     *
     * @Route("/{id}", name="salon_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UmgConferenciaBundle:Salon')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Salon entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('salon'));
    }

    /**
     * Creates a form to delete a Salon entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('salon_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
