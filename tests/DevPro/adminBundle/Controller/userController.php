<?php

namespace Tests\DevPro\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class userControllerTest extends WebTestCase
{
    public function testIndexAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/user');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Hello World")')->count()
        );
    }
}