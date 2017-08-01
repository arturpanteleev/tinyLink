<?php

namespace AppBundle\Services;

use AppBundle\Entity\Link;
use DateTime;
use Doctrine\ORM\EntityManager;

/**
 * Class LinkCreator
 * @package AppBundle\Services
 */
class LinkCreator
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * LinkCreator constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Create and persist link in db
     *
     * @param  string        $originalLink
     * @param  DateTime|null $expiredTime
     * @return Link
     */
    public function create(string $originalLink, DateTime $expiredTime = null): Link
    {
        $link = new Link($originalLink, $expiredTime);
        $this->entityManager->persist($link);
        $this->entityManager->flush();

        return $link;
    }
}
