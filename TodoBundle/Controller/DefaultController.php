<?php

namespace TD\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TDTodoBundle:Default:index.html.twig', array('name' => $name));
    }
}
