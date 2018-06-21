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
use Sulu\Bundle\ExampleEventBundle\Model\Command\RemoveEventCommand;
use Sulu\Bundle\ExampleEventBundle\Model\EventId;

class RemoveEventCommandTest extends TestCase
{
    public function testGetEventId()
    {
        $command = new RemoveEventCommand('123-123-123');

        $this->assertInstanceOf(EventId::class, $command->getEventId());
        $this->assertEquals('123-123-123', $command->getEventId()->getId());
    }
}
