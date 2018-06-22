<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ExampleEventBundle\Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use Sulu\Bundle\ExampleEventBundle\Model\Event;

class EventTest extends TestCase
{
    public function testGetId()
    {
        $event = new Event('123-123-123');

        $this->assertEquals('123-123-123', $event->getId());
    }

    public function testGetIdWithGeneration()
    {
        $event = new Event();

        $this->assertTrue(is_string($event->getId()));
    }

    public function testGetTitle()
    {
        $event = new Event();
        $event->setTitle('Sulu');

        $this->assertEquals('Sulu', $event->getTitle());
    }

    public function testGetDescription()
    {
        $event = new Event();
        $event->setDescription('Sulu is awesome');

        $this->assertEquals('Sulu is awesome', $event->getDescription());
    }

    public function testGetStartDate()
    {
        $startDate = $this->prophesize(\DateTime::class);

        $event = new Event();
        $event->setStartDate($startDate->reveal());

        $this->assertEquals($startDate->reveal(), $event->getStartDate());
    }

    public function testGetEndDate()
    {
        $endDate = $this->prophesize(\DateTime::class);

        $event = new Event();
        $event->setEndDate($endDate->reveal());

        $this->assertEquals($endDate->reveal(), $event->getEndDate());
    }
}
