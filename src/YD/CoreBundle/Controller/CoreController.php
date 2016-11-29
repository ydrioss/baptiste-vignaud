<?php

namespace YD\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function cvAction()
    {
        return $this->render('YDCoreBundle:Core:cv.html.twig');
    }

    public function aboutAction()
    {
      return $this->render('YDCoreBundle:Core:about.html.twig');
    }

    public function contactAction()
    {
      return $this->render('YDCoreBundle:Core:contact.html.twig');
    }
}
