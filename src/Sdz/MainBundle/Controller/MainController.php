<?php
namespace Sdz\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
	public function indexAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		$categories = $em->getRepository('SdzMainBundle:Categorie')->findAll();
		
		if($id==0)
			$produits = $em->getRepository('SdzMainBundle:Produit')->findAll();
		else
			$produits = $em->getRepository('SdzMainBundle:Produit')->findProdCat($id);

		return $this->render('SdzMainBundle:Main:index.html.twig', array('categories'=>$categories,'produits'=>$produits));
	}

}
