<?php
namespace Sdz\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sdz\MainBundle\Entity\Utilisateur;
use Sdz\MainBundle\Entity\Categorie;
use Sdz\MainBundle\Entity\Produit;
use Sdz\MainBundle\Form\UtilisateurType;
use Sdz\MainBundle\Form\CategorieType;
use Sdz\MainBundle\Form\ProduitType;

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
		$produit = new Produit();

		$form = $this->createForm(new ProduitType(), $produit);

		$request = $this->getRequest();

		if($request->getMethod() == 'POST')
		{

			$form->bind($request);

			if($form->isValid())
			{

				$em = $this->getDoctrine()->getManager();

				$categorie = $em->getRepository('SdzMainBundle:Categorie')->find($produit->getCategorie()->getId());

				$produit->setCategorie($categorie);

				$em->persist($produit);

				$em->flush();

				return $this->redirect($this->generateUrl('admin_produits'));
			}
		}
		return $this->render('SdzMainBundle:Admin:nouvprod.html.twig', array('form' => $form->createView()));
	}

	public function modifProdAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		$produit = $em->getRepository('SdzMainBundle:Produit')->find($id);

		$form = $this->createForm(new ProduitType(), $produit);

		$request = $this->getRequest();

		if($request->getMethod() == 'POST')
		{
			$form->bind($request);
			
			if($form->isValid())
			{

				$categorie = $em->getRepository('SdzMainBundle:Categorie')->find($produit->getCategorie()->getId());

				$produit->setCategorie($categorie);

				$em->persist($produit);

				$em->flush();

				return $this->redirect($this->generateUrl('admin_produits'));
			}
		}
		return $this->render('SdzMainBundle:Admin:modifprod.html.twig', array('id' => $id, 'form' => $form->createView()));
	}

	public function supProdAction($id)
	{
		$request = $this->getRequest();

		if($request->getMethod() == 'POST')
		{
			if($request->get('rep') == 'Oui')
			{
				$em = $this->getDoctrine()->getManager();

				$produit = $em->getRepository('SdzMainBundle:Produit')->find($id);

				$produit->setCategorie(null);

				$em->remove($produit);

				$em->flush();
			}
			return $this->redirect($this->generateUrl('admin_produits'));
		}
		return $this->render('SdzMainBundle:Admin:supprod.html.twig', array('id' => $id));
	}



	public function categoriesAction()
	{
		$em = $this->getDoctrine()->getManager();

		$categories = $em->getRepository('SdzMainBundle:Categorie')->findAll();

		return $this->render('SdzMainBundle:Admin:categories.html.twig', array('categories' => $categories));
	}

	public function nouvCatAction()
	{
		$categorie = new Categorie();
		
		$form = $this->createForm(new CategorieType(), $categorie);

		$request = $this->getRequest();
		
		if($request->getMethod() == 'POST')
		{
			$form->bind($request);

			if($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($categorie);

				$em->flush();

				return $this->redirect($this->generateUrl('admin_categories'));
			}

		}

		return $this->render('SdzMainBundle:Admin:nouvcat.html.twig', array('form' => $form->createView()));
	}
	
	public function modifCatAction($id)
	{
		$em = $this->getDoctrine()->getManager();
	
		$categorie = $em->getRepository('SdzMainBundle:Categorie')->find($id);

		$form = $this->createForm(new CategorieType(), $categorie);

		$request = $this->getRequest();

		if($request->getMethod() == 'POST')
		{
			$form->bind($request);

			if($form->isValid())
			{
				$em->persist($categorie);

				$em->flush();

				return $this->redirect($this->generateUrl('admin_categories'));
			}
			
		}
		return $this->render('SdzMainBundle:Admin:modifcat.html.twig', array('id' => $id, 'form' => $form->createView()));
	}

	public function supCatAction($id)
	{
		$request = $this->getRequest();

		if($request->getMethod() == 'POST')
		{

			if($request->get('rep') == 'Oui')
			{
				$em = $this->getDoctrine()->getManager();

				$categorie = $em->getRepository('SdzMainBundle:Categorie')->find($id);

				$em->remove($categorie);

				$em->flush();
			}
			
			return $this->redirect($this->generateUrl('admin_categories'));
		}
		return $this->render('SdzMainBundle:Admin:supcat.html.twig', array('id' => $id));
	}

	public function commandesAction()
	{
		$em = $this->getDoctrine()->getManager();
		
		$commandes = $em->getRepository('SdzMainBundle:Commande')->getMontantCommande();

		return $this->render('SdzMainBundle:Admin:commandes.html.twig', array('commandes' => $commandes));
	}

	public function voirComAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		$commande = $em->getRepository('SdzMainBundle:Commande')->getCommande($id);

		$lignes = $em->getRepository('SdzMainBundle:LigneCommande')->getLignesCommande($id);

		return $this->render('SdzMainBundle:Admin:voircom.html.twig', array('commande' => $commande, 'lignes' => $lignes));
		
	}

}
