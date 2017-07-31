<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Link
 *
 * @ORM\Table(name="link", uniqueConstraints={@ORM\UniqueConstraint(name="tiny", columns={"tiny"})})
 * @ORM\Entity
 */
class Link
{
    /**
     * @var string
     *
     * @ORM\Column(name="original", type="string", length=2048, nullable=false)
     */
    private $original;

    /**
     * @var string
     *
     * @ORM\Column(name="tiny", type="string", length=15, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="AppBundle\Doctrine\LinkUIDGenerator")
     */
    private $tiny;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expired_time", type="datetime", nullable=true)
     */
    private $expiredTime;

    /**
     * @var Visit[]
     * @OneToMany(targetEntity="Visit", mappedBy="link")*
     */
    private $visits;

    /**
     * Link constructor.
     * @param string        $original
     * @param DateTime|null $expiredTime
     */
    public function __construct(string $original, DateTime $expiredTime = null)
    {
        $this->original = $original;
        $this->expiredTime = $expiredTime;
    }

    public function getOriginal(): string
    {
        return $this->original;
    }

    public function getTiny(): string
    {
        return $this->tiny;
    }

    public function getVisits()
    {
        return $this->visits;
    }
}
