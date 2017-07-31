<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Visit
 *
 * @ORM\Table(name="visit")
 * @ORM\Entity
 */
class Visit
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Link
     *
     * @ManyToOne(targetEntity="Link", inversedBy="visits"))
     * @JoinColumn(name="link_id", referencedColumnName="tiny")
     */
    private $link;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visit_time", type="datetime", nullable=false)
     */
    private $visitTime;

    /**
     * @var string
     *
     * @ORM\Column(name="geo", type="string", length=255, nullable=true)
     */
    private $geo;

    /**
     * @var string
     *
     * @ORM\Column(name="user_agent", type="string", length=255, nullable=true)
     */
    private $userAgent;

    public function __construct(Link $link, DateTime $visitTime, $geo, string $userAgent)
    {
        $this->link = $link;
        $this->visitTime = $visitTime;
        $this->geo = $geo;
        $this->userAgent = $userAgent;
    }

    public function getGeo() :string
    {
        return $this->geo;
    }

    public function getUserAgent() :string
    {
        return $this->userAgent;
    }

    public function getVisitTime() : DateTime
    {
        return $this->visitTime;
    }
}
