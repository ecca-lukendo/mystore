<?php
namespace Sdz\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sdz\MainBundle\Entity\Utilisateur;
use Sdz\MainBundle\Form\UtilisateurType;

class AdminController extends Controller
{
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$utilisateurs = $em->getRepository('SdzMainBundle:Utilisateur')->findAll();

		return $this->render('SdzMainBundle:Admin:index.html.twig', array('utilisateurs'=>$utilisateurs));
	}

	public function nouvUtilAction()
	{
		$utilisateur = new Utilisateur();

		$form = $this->createForm(new UtilisateurType(), $utilisateur);

		$request = $this->get('request');

		if( $request->getMethod() == 'POST')
		{	
			$form->bind($request);

			if($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$utilisateur->setRoles("ROLE_USER");

				$em->persist($utilisateur);
			
				$em->flush();

				return $this->redirect($this->generateUrl('admin'));
			}			
			
		}

		return $this->render('SdzMainBundle:Admin:nouvutil.html.twig', array('form' => $form->createView()));
	}

	public function modifUtilAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		$utilisateur = $em->getRepository('SdzMainBundle:Utilisateur')->find($id);

		$form = $this->createForm(new UtilisateurType(), $utilisateur);

		$request = $this->getRequest();

		if( $request->getMethod() == 'POST')
		{	
			$form->bind($request);

			if($form->isValid())
			{
				$utilisateur->setRoles("ROLE_USER");

				$em->persist($utilisateur);
			
				$em->flush();

				return $this->redirect($this->generateUrl('admin'));
			}			
			
		}

		return $this->render('SdzMainBundle:Admin:modifutil.html.twig', array('id' => $id, 'form' => $form->createView()));
	}

	public function supUtilAction($id)
	{
		$request = $this->getRequest();

		if( $request->getMethod() == 'POST')
		{
			if($request->get('rep') == 'Oui')
			{
				$em = $this->getDoctrine()->getManager();

				$utilisateur = $em->getRepository('SdzMainBundle:Utilisateur')->find($id);

				$em->remove($utilisateur);

				$em->flush();
	
			}

			return $this->redirect($this->generateUrl('admin'));
		}

		return $this->render('SdzMainBundle:Admin:suputil.html.twig', array('id' => $id));
	}

	public function produitsAction()
	{
		$em = $this->getDoctrine()->getManager();

		$produits = $em->getRepository('SdzMainBundle:Produit')->findAll();

		return $this->render('SdzMainBundle:Admin:produits.html.twig', array('produits' => $produits));
	}

	public function nouvProdAction()
	{
		return $this->render('SdzMainBundle:Admin:nouvprod.html.twig');
	}

	public function modifProdAction($id)
	{
		return $this->render('SdzMainBundle:Admin:modifprod.html.twig');
	}

	public function supProdAction($id)
	{
		return $this->render('SdzMainBundle:Admin:supprod.html.twig');
	}



	public function categoriesAction()
	{
		$em = $this->getDoctrine()->getManager();

		$categories = $em->getRepository('SdzMainBundle:Categorie')->findAll();

		return $this->render('SdzMainBundle:Admin:categories.html.twig', array('categories' => $categories));
	}

	public function nouvCatAction()
	{
		return $this->render('SdzMainBundle:Admin:nouvcat.html.twig');
	}
	
	public function modifCatAction($id)
	{
		return $this->render('SdzMainBundle:Admin:modifcat.html.twig');
	}

	public function supCatAction($id)
	{
		return $this->render('SdzMainBundle:Admin:supcat.html.twig');
	}



}
