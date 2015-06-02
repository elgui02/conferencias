<?php

namespace Umg\ConferenciaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\ConferenciaBundle\Entity\Alumno;
use Umg\ConferenciaBundle\Entity\AlumnoPago;
use Umg\ConferenciaBundle\Entity\Evento;
use Umg\ConferenciaBundle\Form\AlumnoPagoType;

/**
 * AlumnoPago controller.
 *
 * @Route("/alumnopago")
 */
class AlumnoPagoController extends Controller
{

    /**
     * Lists all AlumnoPago entities.
     *
     * @Route("/", name="alumnopago")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UmgConferenciaBundle:AlumnoPago')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Lists all Eventos entities.
     *
     * @Route("/eventos", name="pagoeventos")
     * @Method("GET")
     * @Template()
     */
    public function eventoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UmgConferenciaBundle:Evento')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Eventos entities.
     *
     * @Route("/{id}/alumnos", name="pagoalumnos")
     * @Method("GET")
     * @Template()
     */
    public function alumnoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('UmgConferenciaBundle:Evento')->find($id);
        $entities = $em->getRepository('UmgConferenciaBundle:Alumno')->findAlumnosSinPagar($ev);

        return array(
            'evento'   => $ev,
            'entities' => $entities,
        );
    }


    /**
     * Creates a new AlumnoPago entity.
     *
     * @Route("/", name="alumnopago_create")
     * @Method("POST")
     * @Template("UmgConferenciaBundle:AlumnoPago:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new AlumnoPago();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->beginTransaction();
 
            try {
                
                $em->persist($entity);
                $em->flush();

                if(!$entity->getAlumno()->getUsuario())
                {
                    $userManager = $this->container->get('fos_user.user_manager');

                    $userAdmin = $userManager->createUser();

                    $userAdmin->setUsername($entity->getAlumno()->getCarne());
                    $userAdmin->setEmail($entity->getAlumno()->getCarne().'@umg.com');
                    $userAdmin->setPlainPassword($entity->getAlumno()->getCarne());
                    $userAdmin->setEnabled(true);

                    $userManager->updateUser($userAdmin, true);
                    

                    $alumno = $entity->getAlumno();
                    $alumno->setUsuario($userAdmin);

                    $em->persist($alumno);
                    $em->flush();
                }
                $em->getConnection()->commit();
                return $this->redirect($this->generateUrl('pagoalumnos', array('id' => $entity->getEvento()->getId())));
                 
            } 
            catch (Exception $e) {
                 $em->getConnection()->rollback();
                 return array(
                        'entity' => $entity,
                        'form'   => $form->createView(),
                    );
                 throw $e;
            }         
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a AlumnoPago entity.
     *
     * @param AlumnoPago $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(AlumnoPago $entity)
    {
        $form = $this->createForm(new AlumnoPagoType(), $entity, array(
            'action' => $this->generateUrl('alumnopago_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AlumnoPago entity.
     *
     * @Route("/{ida}/new/{ide}", name="alumnopago_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($ida,$ide)
    {
        $em = $this->getDoctrine()->getManager();
        $ev = $em->getRepository('UmgConferenciaBundle:Evento')->find($ide);
        $al = $em->getRepository('UmgConferenciaBundle:Alumno')->find($ida);

        $entity = new AlumnoPago();
        $entity->setAlumno($al);
        $entity->setEvento($ev);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AlumnoPago entity.
     *
     * @Route("/{id}", name="alumnopago_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:AlumnoPago')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AlumnoPago entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AlumnoPago entity.
     *
     * @Route("/{id}/edit", name="alumnopago_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:AlumnoPago')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AlumnoPago entity.');
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
    * Creates a form to edit a AlumnoPago entity.
    *
    * @param AlumnoPago $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AlumnoPago $entity)
    {
        $form = $this->createForm(new AlumnoPagoType(), $entity, array(
            'action' => $this->generateUrl('alumnopago_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AlumnoPago entity.
     *
     * @Route("/{id}", name="alumnopago_update")
     * @Method("PUT")
     * @Template("UmgConferenciaBundle:AlumnoPago:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgConferenciaBundle:AlumnoPago')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AlumnoPago entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('alumnopago_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AlumnoPago entity.
     *
     * @Route("/{id}", name="alumnopago_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UmgConferenciaBundle:AlumnoPago')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AlumnoPago entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('alumnopago'));
    }

    /**
     * Creates a form to delete a AlumnoPago entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alumnopago_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
