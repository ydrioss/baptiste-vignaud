<?php

namespace YD\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

use YD\PortfolioBundle\Entity\Work;
use YD\PortfolioBundle\Form\WorkType;

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

    public function addAction(Request $request)
    {
      $work = new Work();
      $form = $this->get('form.factory')->create(WorkType::class, $work);

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($work);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice',  'Projet bien enregistré.');

        return $this->redirectToRoute('yd_portfolio_work', array('slug' => $work->getSlug()));
      }

      return $this->render('YDPortfolioBundle:Portfolio:add.html.twig', array(
        'form' => $form->createView(),
      ));
    }
}
