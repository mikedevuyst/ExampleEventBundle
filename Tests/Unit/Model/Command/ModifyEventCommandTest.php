<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ExampleEventBundle\Tests\Unit\Model\Command;

use PHPUnit\Framework\TestCase;
use Sulu\Bundle\ExampleEventBundle\Model\Command\ModifyEventCommand;
use Sulu\Bundle\ExampleEventBundle\Model\EventId;

class ModifyEventCommandTest extends TestCase
{
    public function testGetEventId()
    {
        $command = new ModifyEventCommand('123-123-123', ['title' => 'Sulu']);

        $this->assertInstanceOf(EventId::class, $command->getEventId());
        $this->assertEquals('123-123-123', $command->getEventId()->getId());
    }

    public function testGetTitle()
    {
        $command = new ModifyEventCommand('123-123-123', ['title' => 'Sulu']);

        $this->assertEquals('Sulu', $command->getTitle());
    }

    public function testGetDescription()
    {
        $command = new ModifyEventCommand('123-123-123', ['description' => 'Sulu is awesome']);

        $this->assertEquals('Sulu is awesome', $command->getDescription());
    }

    public function testGetStartDate()
    {
        $startDate = $this->prophesize(\DateTime::class);

        $command = new ModifyEventCommand('123-123-123', ['startDate' => $startDate->reveal()]);

        $this->assertEquals($startDate->reveal(), $command->getStartDate());
    }

    public function testGetEndDate()
    {
        $endDate = $this->prophesize(\DateTime::class);

        $command = new ModifyEventCommand('123-123-123', ['endDate' => $endDate->reveal()]);

        $this->assertEquals($endDate->reveal(), $command->getEndDate());
    }
}
