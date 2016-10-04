<?php

namespace YD\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('YDCoreBundle:Default:index.html.twig');
    }
}
