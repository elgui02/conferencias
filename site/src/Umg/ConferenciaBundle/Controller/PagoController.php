<?php

namespace Umg\ConferenciaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\ConferenciaBundle\Entity\Pago;
use Umg\ConferenciaBundle\Form\PagoType;

/**
 * Pago controller.
 *
 * @Route("/pago")
 */
class PagoController extends Controller
{

    /**
     * Lists all Pago entities.
     *
     * @Route("/", name="pago")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UmgConferenciaBundle:Pago')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Pago entity.
     *
     * @Route("/{id}/crear", name="pago_create")
     * @Method("POST")
     * @Template("UmgConferenciaBundle:Pago:new.html.twig")
     */
    public function createAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $evento = $em->getRepository('UmgConferenciaBundle:Evento')->find($id);

        $entity = new Pago();
        $form = $this->createCreateForm($entity,$id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->getConnection()->beginTransaction();
            try {

                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                $conf = $em->getRepository('UmgConferenciaBundle:Conferencium')->findBy(array(
                    'evento'=>$evento,
                    'conferencistum'=>$entity->getConferencistum(),
                ));
                foreach($conf as $cc)
                {
                    $cc->setPagado(true);
                    $em->persist($cc);
                    $em->flush();
                }
                $em->getConnection()->commit();
                return $this->redirect($this->generateUrl('evento_viaticos', array('id' => $id)));
            } 
            catch (Exception $e) {
                $em->getConnection()->rollback();
                throw $e;
                return array(
                    'entity' => $entity,
                    'form'   => $form->createView(),
                );
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Pago entity.
     *
     * @param Pago $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pago $entity,$ev)
    {
        $form = $this->createForm(new PagoType(), $entity, array(
            'action' => $this->generateUrl('pago_create',array('id'=>$ev)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Pago entity.
     *
     * @Route("/{id}/new/{ev}", name="pago_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id,$ev)
    {
        $em = $this->getDoctrine()->getManager();
        $conf = $em->getRepository('UmgConferenciaBundle:Conferencistum')->find($id);
        $evento = $em->getRepository('UmgConferenciaBundle:Evento')->find($ev);
        $entity = new Pago();
        $entity->setConferencistum($conf);
        $usr = $this->get('security.token_storage')->getToken()->getUser();
        $entity->setUsuario($usr);
        $form   = $this->createCreateForm($entity,$evento->getId());

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pago entity.
     *
     * @Route("/{id}", name="pago_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Pago')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pago entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Pago entity.
     *
     * @Route("/{id}/edit", name="pago_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Pago')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pago entity.');
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
    * Creates a form to edit a Pago entity.
    *
    * @param Pago $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pago $entity)
    {
        $form = $this->createForm(new PagoType(), $entity, array(
            'action' => $this->generateUrl('pago_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Pago entity.
     *
     * @Route("/{id}", name="pago_update")
     * @Method("PUT")
     * @Template("UmgConferenciaBundle:Pago:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:Pago')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pago entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pago_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Pago entity.
     *
     * @Route("/{id}", name="pago_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UmgConferenciaBundle:Pago')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pago entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pago'));
    }

    /**
     * Creates a form to delete a Pago entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pago_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
