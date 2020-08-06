<?php

namespace AD\CoreBundle\Tests\Controller\WebTestCase;

use Tests\CoreBundle\DataFixtures\DataFixtureTestCase;

class UrlControllerTest extends DataFixtureTestCase
{
	
	/**
	 * {@inheritDoc}
	 */
	public function setUp(): void
	{
		parent::setUp();
	}
	
	/**
	 * @dataProvider provideDirectUrls
	 */
	public function testIndex($url)
	{
		
		echo "Tested Url: ".$url."\n";
		$this->client->request('GET', $url);
		$this->assertTrue($this->client->getResponse()->isSuccessful());
	}
	
	
	public function provideDirectUrls()
	{
		return [
				['/']
		];
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function tearDown(): void
	{
		parent::tearDown();
	}
}
