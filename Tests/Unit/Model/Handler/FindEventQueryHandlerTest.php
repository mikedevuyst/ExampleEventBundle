<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ExampleEventBundle\Tests\Unit\Model\Handler;

use PHPUnit\Framework\TestCase;
use Sulu\Bundle\ExampleEventBundle\Model\Event;
use Sulu\Bundle\ExampleEventBundle\Model\EventId;
use Sulu\Bundle\ExampleEventBundle\Model\EventRepositoryInterface;
use Sulu\Bundle\ExampleEventBundle\Model\Handler\FindEventQueryHandler;
use Sulu\Bundle\ExampleEventBundle\Model\Query\FindEventQuery;

class FindEventQueryHandlerTest extends TestCase
{
    public function testHandle()
    {
        $eventRepository = $this->prophesize(EventRepositoryInterface::class);
        $handler = new FindEventQueryHandler($eventRepository->reveal());

        $eventId = $this->prophesize(EventId::class);

        $command = $this->prophesize(FindEventQuery::class);
        $command->getEventId()->willReturn($eventId->reveal());

        $event = $this->prophesize(Event::class);

        $eventRepository->findById($eventId->reveal())->willReturn($event->reveal())->shouldBeCalled();

        $this->assertEquals($event->reveal(), $handler->handle($command->reveal()));
    }
}
