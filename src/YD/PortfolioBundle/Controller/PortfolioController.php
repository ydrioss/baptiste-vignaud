<?php

namespace YD\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function workAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $work = $em->getRepository('YDPortfolioBundle:Work')->find($id);

        if (null === $work) {
          throw new NotFoundHttpException("Le projet" . $id . "n'existe pas");

        }

        return $this->render('YDPortfolioBundle:Portfolio:work.html.twig', array(
          'work' => $work
        ));
    }
}
