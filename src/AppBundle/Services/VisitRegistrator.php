<?php

namespace AppBundle\Services;

use AppBundle\Entity\Link;
use AppBundle\Entity\Visit;
use DateTime;
use Doctrine\ORM\EntityManager;

class VisitRegistrator
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var RequestInfoExtractor
     */
    private $requestInfoExtractor;

	/**
	 * VisitRegistrator constructor.
	 * @param EntityManager $entityManager
	 * @param RequestInfoExtractor $requestInfoExtractor
	 */
    public function __construct(EntityManager $entityManager, RequestInfoExtractor $requestInfoExtractor)
    {
        $this->entityManager = $entityManager;
        $this->requestInfoExtractor = $requestInfoExtractor;
    }

    /**
     * Фиксирует инормацию о посещении ссылки
     * @param Link $link
     */
    public function register(Link $link): void
    {
        $visitDate = new DateTime();

        $geo = $this->requestInfoExtractor->getGeo();
        $userAgent = $this->requestInfoExtractor->getUserAgent();

        $visit = new Visit($link, $visitDate, $geo, $userAgent);
        $this->entityManager->persist($visit);
        $this->entityManager->flush();
    }
}
