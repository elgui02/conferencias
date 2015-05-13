<?php

namespace Umg\ConferenciaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\ConferenciaBundle\Entity\Conferencistum;
use Umg\ConferenciaBundle\Form\ConferencistumType;

/**
 * Conferencistum controller.
 *
 * @Route("/conferencista")
 */
class ConferencistumController extends Controller
{

    /**
     * Lists all Conferencistum entities.
     *
     * @Route("/", name="conferencista")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UmgConferenciaBundle:Conferencistum')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Conferencistum entity.
     *
     * @Route("/", name="conferencista_create")
     * @Method("POST")
     * @Template("UmgConferenciaBundle:Conferencistum:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Conferencistum();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('conferencista_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Conferencistum entity.
     *
     * @param Conferencistum $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Conferencistum $entity)
    {
        $form = $this->createForm(new ConferencistumType(), $entity, array(
            'action' => $this->generateUrl('conferencista_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Conferencistum entity.
     *
     * @Route("/new", name="conferencista_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Conferencistum();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Conferencistum entity.
     *
     * @Route("/{id}", name="conferencista_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Conferencistum')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conferencistum entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Conferencistum entity.
     *
     * @Route("/{id}/edit", name="conferencista_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Conferencistum')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conferencistum entity.');
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
    * Creates a form to edit a Conferencistum entity.
    *
    * @param Conferencistum $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Conferencistum $entity)
    {
        $form = $this->createForm(new ConferencistumType(), $entity, array(
            'action' => $this->generateUrl('conferencista_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Conferencistum entity.
     *
     * @Route("/{id}", name="conferencista_update")
     * @Method("PUT")
     * @Template("UmgConferenciaBundle:Conferencistum:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Conferencistum')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Conferencistum entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('conferencista_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Conferencistum entity.
     *
     * @Route("/{id}", name="conferencista_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UmgConferenciaBundle:Conferencistum')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Conferencistum entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('conferencista'));
    }

    /**
     * Creates a form to delete a Conferencistum entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('conferencista_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
