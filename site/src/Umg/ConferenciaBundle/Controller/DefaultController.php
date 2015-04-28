<?php

namespace Umg\ConferenciaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UmgConferenciaBundle:Default:index.html.twig', array('name' => $name));
    }
}
