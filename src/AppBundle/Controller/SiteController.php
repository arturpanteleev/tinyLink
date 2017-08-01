<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Base controller that simply return client side to working with api
 *
 * Class SiteController
 * @package AppBundle\Controller
 */
class SiteController extends Controller
{
	/**
	 * @Route("/", name="homepage")
	 * @Method({"GET"})
	 */
	public function indexAction()
	{
		return $this->render('default/index.html.twig', [
			'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
		]);
	}
}