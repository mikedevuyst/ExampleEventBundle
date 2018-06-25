<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ExampleEventBundle\Tests\Functional\Controller;

use Sulu\Bundle\ExampleEventBundle\Tests\Functional\Traits\EventTrait;
use Sulu\Bundle\TestBundle\Testing\SuluTestCase;

class EventControllerTest extends SuluTestCase
{
    use EventTrait;

    public function setUp()
    {
        parent::setUp();

        $this->purgeDatabase();
    }

    public function testCGet()
    {
        $event = $this->createEvent();
        $event->setStartDate(new \DateTime('2018-01-01'));
        $event->setEndDate(new \DateTime('2018-12-31'));

        $client = $this->createAuthenticatedClient();
        $client->request(
            'GET',
            '/api/events'
        );

        $result = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $events = $result['_embedded']['events'];

        $this->assertCount(1, $events);
        $this->assertEquals(1, $result['total']);

        $this->assertEquals($event->getTitle(), $events[0]['title']);
    }

    public function testGet()
    {
        $event = $this->createEvent();
        $event->setStartDate(new \DateTime('2018-01-01'));
        $event->setEndDate(new \DateTime('2018-12-31'));
        $this->getEntityManager()->flush();

        $client = $this->createAuthenticatedClient();
        $client->request(
            'GET',
            '/api/events/' . $event->getId()
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $result = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals($event->getId(), $result['id']);
        $this->assertEquals('Sulu', $result['title']);
        $this->assertEquals('Sulu is awesome', $result['description']);
        $this->assertEquals('2018-01-01', $result['startDate']);
        $this->assertEquals('2018-12-31', $result['endDate']);
    }

    public function testPost()
    {
        $client = $this->createAuthenticatedClient();
        $client->request(
            'POST',
            '/api/events',
            [
                'title' => 'Sulu',
                'description' => 'Sulu is awesome',
                'startDate' => '2018-01-01',
                'endDate' => '2018-12-31',
            ]
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $result = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('id', $result);
        $this->assertEquals('Sulu', $result['title']);
        $this->assertEquals('Sulu is awesome', $result['description']);
        $this->assertEquals('2018-01-01', $result['startDate']);
        $this->assertEquals('2018-12-31', $result['endDate']);
    }

    public function testPut()
    {
        $event = $this->createEvent('XXX', 'Sulu is great');

        $client = $this->createAuthenticatedClient();
        $client->request(
            'PUT',
            '/api/events/' . $event->getId(),
            [
                'title' => 'Sulu',
                'description' => 'Sulu is awesome',
                'startDate' => '2018-01-01',
                'endDate' => '2018-12-31',
            ]
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $result = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals($event->getId(), $result['id']);
        $this->assertEquals('Sulu', $result['title']);
        $this->assertEquals('Sulu is awesome', $result['description']);
        $this->assertEquals('2018-01-01', $result['startDate']);
        $this->assertEquals('2018-12-31', $result['endDate']);
    }

    public function testDelete()
    {
        $event = $this->createEvent();

        $client = $this->createAuthenticatedClient();
        $client->request(
            'DELETE',
            '/api/events/' . $event->getId()
        );

        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }
}
