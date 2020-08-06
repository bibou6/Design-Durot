<?php

namespace AD\CoreBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

class LoadBasicData extends Fixture implements FixtureInterface
{
	protected $requestStack;

	public function __construct(RequestStack $requestStack)
	{
		$this->requestStack = $requestStack;
	}

	public function load(ObjectManager $manager)
	{
		$request = new Request();
		$request->setSession(new Session(new MockFileSessionStorage()));
		$this->requestStack->push($request);

	}
}
