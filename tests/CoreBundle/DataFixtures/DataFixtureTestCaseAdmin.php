<?php
namespace Tests\CoreBundle\DataFixtures;

use AD\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DataFixtureTestCaseAdmin extends WebTestCase
{
	/** @var   $application */
	protected static $application;
	
	/** @var   $client */
	protected $client;
	
	/** @var   $container */
	protected $container;
	
	/** @var  EntityManager $entityManager */
	protected $entityManager;
	
	protected $user;
	
	/**
	 * {@inheritDoc}
	 */
	public function setUp(): void
	{
		
		$this->client = static::createClient();
		$this->container = $this->client->getContainer();
		$requestStack = $this->container->get("request_stack");
		
		$request = new Request();
		$request->setSession(new Session(new MockFileSessionStorage()));
		$requestStack->push($request);
		
		$this->entityManager = $this->container->get('doctrine.orm.entity_manager');
		parent::setUp();
		$this->logIn();
	}
	
	protected static function runCommand($command,$client)
	{
		$command = sprintf('%s --quiet', $command);
		
		return self::getApplication($client)->run(new StringInput($command));
	}
	
	protected static function getApplication($client)
	{
		if (null === self::$application) {
			self::$application = new Application($client->getKernel());
			self::$application->setAutoExit(false);
		}
		
		return self::$application;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function tearDown(): void
	{
		parent::tearDown();
		//$this->entityManager->close();
		//$this->entityManager = null; // avoid memory leaks
		
	}
	
	private function logIn()
	{
		$session = $this->client->getContainer()->get('session');
		
		$this->user = $this->entityManager->getRepository(User::class)->findOneByUsername("admin");
		
		$token = new UsernamePasswordToken($this->user, null, 'main', array('ROLE_ADMIN'));
		$this->client->getContainer()->get('security.token_storage')->setToken($token);
		$session->set('_security_main', serialize($token));
		
		$session->save();
		
		$cookie = new Cookie($session->getName(), $session->getId());
		$this->client->getCookieJar()->set($cookie);
		
	}
}