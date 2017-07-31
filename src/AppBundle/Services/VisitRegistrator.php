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
    private $request;

    /**
     * VisitCreator constructor.
     * @param EntityManager $entityManager
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
        /**
         * @todo прикрутить сервис получения geo инфы
         */
        $geo = $this->requestInfoExtractor->getGeo();
        $userAgent = $this->requestInfoExtractor->getUserAgent();

        $visit = new Visit($link, $visitDate, $geo, $userAgent);
        $this->entityManager->persist($visit);
        $this->entityManager->flush();
    }
}
