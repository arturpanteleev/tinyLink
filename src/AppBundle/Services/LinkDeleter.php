<?php

namespace AppBundle\Services;

use DateTime;
use Doctrine\ORM\EntityManager;

class LinkDeleter
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * LinkDeleter constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Удаляет ссылки с expiredDate меньше заданной(по умолчанию текущей)
     *
     * @param DateTime|null $oldDate
     */
    public function cleanOldLink(DateTime $oldDate = null): void
    {
        if ($oldDate === null) {
            $oldDate = new DateTime();
        }

        $qb = $this->entityManager->createQueryBuilder();

        $qb->delete('AppBundle:Link', 'link')
            ->where('link.expiredTime <= :date')
            ->andWhere('link.expiredTime is not null')
            ->setParameter('date', $oldDate)
            ->getQuery()
            ->getResult();
    }
}
