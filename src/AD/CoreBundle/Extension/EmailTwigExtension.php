<?php

// src/AppBundle/Twig/AppExtension.php

namespace AD\CoreBundle\Extension;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class EmailTwigExtension extends AbstractExtension
{
	protected $token_storage;

	public function __construct(TokenStorage $security)
	{
		$this->token_storage = $security;
	}

	public function getFilters()
	{
		return [
			new TwigFilter('emails', [$this, 'formatEmails']),
			new TwigFilter('email', [$this, 'formatEmail']),
		];
	}

	public function formatEmails($emails)
	{
		$result = '';
		foreach ($emails as $key => $email) {
			if ($this->token_storage->getToken()->getUser()->getEmail() == $email->getEmail()) {
				$result .= 'Yo';
			} else {
				$result .= $email->getName();
			}

			if ($key != count($emails) - 1) {
				$result .= ', ';
			}
		}

		return $result;
	}

	public function formatEmail($emails)
	{
		$result = '';
		$explodedEmails = explode(',', $emails);
		$size = sizeof($explodedEmails);
		for ($i = 0; $i < $size; ++$i) {
			if ($this->token_storage->getToken()->getUser()->getEmail() == $explodedEmails[$i]) {
				$result .= 'Yo';
			} else {
				switch ($explodedEmails[$i]) {
					case 'gis.greco@gmail.com':
						$result .= 'Giselle';
						break;
					case 'gestioninmobiliaria.greco@gmail.com':
						$result .= 'Dixiana';
						break;
					case 'adriendurot3@hotmail.com':
						$result .= 'Dixiana';
						break;
					case 'fleonandrade@gmail.com':
						$result .= 'Fabiola';
						break;
					default:
						$result .= $explodedEmails[$i];
						break;
				}
			}

			if ($i != sizeof($explodedEmails) - 1) {
				$result .= ', ';
			}
		}

		return $result;
	}
}
