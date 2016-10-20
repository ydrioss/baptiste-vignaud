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

    public function editAction($id, Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $work = $em->getRepository('YDPortfolioBundle:Work')->find($id);
      if (null === $work) {
        throw new NotFoundHttpException("Le projet d'id" .$id. "n'existe pas.");
      }

      $form = $this->get('form.factory')->create(WorkType::class, $work);

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Projet bien modifié.');

        return $this->redirectToRoute('yd_portfolio_work', array(
          'id' => $work->getId()
        ));

        return $this->render('YDPortfolioBundle:Portfolio:edit.html.twig', array(
          'work'  => $work,
          'form'  => $form->createView(),
        ));
      }
    }

    public function deleteAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();
      $work = $em->getRepository('YDPortfolioBundle:Work')->find($id);

      if (null === $work) {
        throw new NotFoundHttpException("Le projet d'id" .$id. "n'existe pas.");
      }

      $form = $this->get('form.factory')->create();

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $em->remove($work);
        $em->flush();

        $request->getSession()->getFlashBag()->add('info', "Projet bien supprimé.");

        return $this->redirectToRoute('yd_portfolio_homepage');
      }

      return $this->render('YDPortfolioBundle:Portfolio:delete.html.twig', array(
        'work' => $work,
        'form' => $form->createView(),
      ));
    }
}
