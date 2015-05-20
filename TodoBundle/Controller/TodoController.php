<?php

namespace TD\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use TD\TodoBundle\Entity\Tache;
use TD\TodoBundle\Form\TacheType;

class TodoController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
		$tache = $em->getRepository('TDTodoBundle:Tache')->findAll();

		return $this->container->get('templating')->renderResponse('TDTodoBundle:Todo:index.html.twig',array(
			 'tache' => $tache)
		);
    }
	
	public function viewAction($id)
    {
        $repository = $this->getDoctrine()
			->getManager()
			->getRepository('TDTodoBundle:Tache')
			;

		$tache = $repository->find($id);

		return $this->render('TDTodoBundle:Todo:view.html.twig', array( 'tache' => $tache));
    }
	
	public function addAction(Request $request)
    {
		$tache= new Tache();
		$form = $this->get('form.factory')->create(new TacheType(), $tache);

		if ($form->handleRequest($request)->isValid()) {
		  $em = $this->getDoctrine()->getManager();
		  $em->persist($tache);
		  $em->flush();

		  $request->getSession()->getFlashBag()->add('notice', 'tache bien enregistrée.');

		  return $this->redirect($this->generateUrl('td_todo_homepage', array('id' => $tache->getId())));
		}

		return $this->render('TDTodoBundle:Todo:add.html.twig', array(
		  'form' => $form->createView(),
		));

    }
	
	public function editAction(Tache $tache)
    {
		$form = $this->createForm(new TacheType(), $tache);

		$request = $this->getRequest();

		if ($request->getMethod() == 'POST') {
		  $form->bind($request);

		  if ($form->isValid()) {
			// On enregistre la tache
			$em = $this->getDoctrine()->getManager();
			$em->persist($tache);
			$em->flush();

			// On définit un message flash
			$this->get('session')->getFlashBag()->add('info', 'Tache bien modifié');

			return $this->redirect($this->generateUrl('td_todo_view', array('id' => $tache->getId())));
		  }
		}

		return $this->render('TDTodoBundle:Todo:edit.html.twig', array(
		  'form'    => $form->createView(),
		  'tache' => $tache
		));
    }

    public function suppAction(Tache $tache)
    {
		$form = $this->createFormBuilder()->getForm();

		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
		  $form->bind($request);

		  if ($form->isValid()) {
			// On supprime l'article
			$em = $this->getDoctrine()->getManager();
			$em->remove($tache);
			$em->flush();

			// On définit un message flash
			$this->get('session')->getFlashBag()->add('info', 'la tach est bien supprimé');

			// Puis on redirige vers l'accueil
			return $this->redirect($this->generateUrl('td_todo_homepage'));
		  }
		}

		// Si la requête est en GET, on affiche une page de confirmation avant de supprimer
		return $this->render('TDTodoBundle:Todo:supp.html.twig', array(
		  'tache' => $tache,
		  'form'    => $form->createView()
		));
    }
}