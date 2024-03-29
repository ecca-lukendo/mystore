<?php
namespace Sdz\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
	public function loginAction()
	{
				$request = $this->getRequest();
        $session = $request->getSession();
 
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
 
        return $this->render('SdzMainBundle:Login:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));

	}

	public function loginCheckAction()
	{
		
	}

	public function logoutAction()
	{

	}

	public function compteAction()
	{

		$security = $this->get('security.context');

		$token = $security->getToken();

		$user = $token->getUser();
		

		 if ($security->isGranted('ROLE_ADMIN')) 
        return $this->redirect($this->generateUrl('admin'));
		return $this->redirect($this->generateUrl('client'));
	}
}
