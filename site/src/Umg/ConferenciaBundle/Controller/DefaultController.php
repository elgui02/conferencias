<?php

namespace Umg\ConferenciaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\ConferenciaBundle\Entity\Alumno;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $alumno = $em->getRepository('UmgConferenciaBundle:Alumno')->findOneByUsuario($user);
        if($alumno)
        {
        	return $this->redirect($this->generateUrl('conferenciaalumno',array('estudiante'=>true)));
        }
        return $this->render('UmgConferenciaBundle:Default:index.html.twig');
    }
}
