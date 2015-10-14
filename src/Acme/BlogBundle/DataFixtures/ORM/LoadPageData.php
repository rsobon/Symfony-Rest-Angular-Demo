<?php

namespace Acme\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Acme\BlogBundle\Entity\Page;

class LoadPageData extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $em)
	{
		$page = new Page();
		$page->setTitle('this is example title');
		$page->setBody('this is example body');
		$em->persist($page);

		$page = new Page();
		$page->setTitle('another awesome title');
		$page->setBody('is this a body, or?...');
		$em->persist($page);

		$em->flush();
	}

	public function getOrder()
	{
		return 2; // the order in which fixtures will be loaded
	}
}