<?php

namespace YD\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PortfolioController extends Controller
{
    public function indexAction()
    {
        return $this->render('YDPortfolioBundle:Portfolio:index.html.twig');
    }

    public function workAction($id)
    {
        return $this->render('YDPortfolioBundle:Portfolio:work.html.twig', array(
          'id' => $id
        ));
    }
}
