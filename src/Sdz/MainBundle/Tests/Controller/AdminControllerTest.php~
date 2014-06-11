<?php
namespace Sdz\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AdminControllerTest extends WebTestCase
{
	public function testCategories()
	{
		$client = static::createClient();
		$client->request('GET', '/admin/categories');
		$this->assertEquals(200, $client->getResponse()->getStatusCode());
	}


}
