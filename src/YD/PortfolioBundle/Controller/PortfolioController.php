<?php

namespace YD\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use YD\PortfolioBundle\Entity\Work;

class PortfolioController extends Controller
{
    public function indexAction()
    {
        $repo = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('YDPortfolioBundle:Work')
        ;

        $listWorks = $repo->findAll();

        return $this->render('YDPortfolioBundle:Portfolio:index.html.twig', array(
          'listWorks' => $listWorks
        ));
    }

    public function workAction(Work $work)
    {
        return $this->render('YDPortfolioBundle:Portfolio:work.html.twig', array(
          'work' => $work
        ));
    }
}
