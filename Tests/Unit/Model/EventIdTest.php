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
use Sulu\Bundle\ExampleEventBundle\Model\EventId;

class EventIdTest extends TestCase
{
    public function testGetId()
    {
        $eventId = new EventId('123-123-123');

        $this->assertEquals('123-123-123', $eventId->getId());
    }

    public function testGetIdWithGeneration()
    {
        $event = new EventId();

        $this->assertTrue(is_string($event->getId()));
    }
}
