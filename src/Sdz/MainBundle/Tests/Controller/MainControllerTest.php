<?php
namespace Sdz\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MainControllerTest extends WebTestCase
{
	public function testIndex()
	{
		$client = static::createClient();
		$client->request('GET', '/produits');
		$this->assertEquals(200, $client->getResponse()->getStatusCode());
	}

}
?>


