<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Link;
use AppBundle\Services\VisitRegistrator;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RedirectController extends Controller
{

	/**
	 * @var VisitRegistrator
	 */
	private $visitRegistrator;

	/**
	 * @var EntityManager
	 */
	private $entityManager;

	public function __construct(VisitRegistrator $visitRegistrator, EntityManager $entityManager)
	{
		$this->visitRegistrator = $visitRegistrator;
		$this->entityManager = $entityManager;
	}

	/**
	 * @Route("/{tinyLink}", name="redirect")
	 */
	public function redirectToFull(string $tinyLink, Request $request)
	{
		$link = $this->getLink($tinyLink);

		$this->visitRegistrator->register($link);

		return new RedirectResponse($link->getOriginal(), RedirectResponse::HTTP_MOVED_PERMANENTLY);
	}

	/**
	 * Получаем ссылку по короткой иначе выбрасываем исключения(вынес в метод чтобы убить дубляж)
	 *
	 * @param $tinyLink
	 * @return Link
	 */
	private function getLink(string $tinyLink): Link
	{
		if (empty($tinyLink))
		{
			throw  new NotFoundHttpException();
		}

		$link = $this->entityManager->find(Link::class, $tinyLink);

		if (empty($link))
		{
			throw  new NotFoundHttpException();
		}

		return $link;
	}
}