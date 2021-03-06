<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2015 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class AdminDashboardTest extends WebTestCase
{
    public function testRedirectToDashboard()
    {
        $client = $this->createClientAuthenticated();

        $client->request('GET', '/admin');

        $this->assertEquals(301, $client->getResponse()->getStatusCode());

        $client->followRedirect();

        $this->assertEquals('http://localhost/en/admin/dashboard', $client->getRequest()->getUri());

        $client->request('GET', '/admin/dashboard');

        $this->assertEquals(301, $client->getResponse()->getStatusCode());

        $client->followRedirect();

        $this->assertEquals('http://localhost/en/admin/dashboard', $client->getRequest()->getUri());
    }

    public function testContents()
    {
        $client = $this->createClientAuthenticated();

        $crawler = $client->request('GET', '/en/admin/dashboard');

        $response = $client->getResponse();
        $this->assertResponseSuccess($response);
        $this->assertContains('Sonata Admin', $response->getContent());

        $this->assertCount(1, $crawler->filter('.container-fluid'));
        $this->assertCount(9, $crawler->filter('.sonata-ba-list-label'));
    }
}
