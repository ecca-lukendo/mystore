<?php
namespace Sdz\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClientController extends Controller
{
	public function indexAction()
	{
		return $this->render('SdzMainBundle:Client:index.html.twig');
	}
}
