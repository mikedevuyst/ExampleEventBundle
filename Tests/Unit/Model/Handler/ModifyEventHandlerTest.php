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
use Sulu\Bundle\ExampleEventBundle\Model\Command\ModifyEventCommand;
use Sulu\Bundle\ExampleEventBundle\Model\Event;
use Sulu\Bundle\ExampleEventBundle\Model\EventRepositoryInterface;
use Sulu\Bundle\ExampleEventBundle\Model\Handler\ModifyEventHandler;

class ModifyEventHandlerTest extends TestCase
{
    public function testHandle()
    {
        $eventRepository = $this->prophesize(EventRepositoryInterface::class);
        $handler = new ModifyEventHandler($eventRepository->reveal());

        $startDate = new \DateTime();
        $endDate = new \DateTime();

        $command = $this->prophesize(ModifyEventCommand::class);
        $command->getId()->willReturn('123-123-123');
        $command->getTitle()->willReturn('Sulu');
        $command->getDescription()->willReturn('Sulu is awesome');
        $command->getStartDate()->willReturn($startDate);
        $command->getEndDate()->willReturn($endDate);

        $event = $this->prophesize(Event::class);
        $event->setTitle('Sulu')->willReturn($event->reveal())->shouldBeCalled();
        $event->setDescription('Sulu is awesome')->willReturn($event->reveal())->shouldBeCalled();
        $event->setStartDate($startDate)->willReturn($event->reveal())->shouldBeCalled();
        $event->setEndDate($endDate)->willReturn($event->reveal())->shouldBeCalled();

        $eventRepository->findById('123-123-123')->willReturn($event->reveal())->shouldBeCalled();

        $this->assertEquals($event->reveal(), $handler->handle($command->reveal()));
    }
}
