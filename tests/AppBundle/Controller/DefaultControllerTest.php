<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * @covers \AppBundle\Controller\DefaultController::indexAction()
     */
    public function testShouldFallWhenMainPageUnavailable()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @covers \AppBundle\Controller\DefaultController::createTinylink()
     */
    public function testCanCreateShortLink()
    {
        $client = static::createClient();
        $link = 'http://imagine-dragons.com';
        $client->request('POST', '/create/', [
            'link' => $link,
            'expiredDate' => null,
        ]);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $response = $client->getResponse()->getContent();
        $response = json_decode($response, true);
        $this->assertArrayHasKey('tinyLink', $response);
        $this->assertArrayHasKey('statisticLink', $response);
        $this->assertNotEmpty($response['tinyLink']);
        $this->assertNotEmpty($response['statisticLink']);
        $this->assertTrue(is_string($response['tinyLink']));
        $this->assertTrue(is_string($response['statisticLink']));
        $this->assertTrue(mb_strlen($response['statisticLink']) > 0);
        $this->assertTrue(mb_strlen($response['tinyLink']) > 0);
    }
}
