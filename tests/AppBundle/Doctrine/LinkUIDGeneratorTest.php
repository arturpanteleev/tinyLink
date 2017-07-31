<?php

namespace Tests\AppBundle\Doctrine;

use AppBundle\Doctrine\LinkUIDGenerator;
use AppBundle\Entity\Link;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LinkUIDGeneratorTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testShouldFallWhenUidIsNotString()
    {
        $link = new Link("http://darkside.ru");
        $LinkUIDGenerator = new LinkUIDGenerator();
        $uid = $LinkUIDGenerator->generate($this->em, $link);

        $this->assertTrue(is_string($uid));
    }

    public function testSholdFallWhenUidLenghtNotPositive()
    {
        $link = new Link("http://darkside.ru");
        $LinkUIDGenerator = new LinkUIDGenerator();
        $uid = $LinkUIDGenerator->generate($this->em, $link);

        $this->assertTrue(mb_strlen($uid) > 0);
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}
