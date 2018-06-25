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
use Sulu\Bundle\ExampleEventBundle\Model\Command\CreateEventCommand;

class CreateEventCommandTest extends TestCase
{
    public function testGetTitle()
    {
        $startDate = $this->prophesize(\DateTime::class);
        $endDate = $this->prophesize(\DateTime::class);

        $command = new CreateEventCommand(
            [
                'title' => 'Sulu',
                'description' => 'Sulu is awesome',
                'startDate' => $startDate->reveal(),
                'endDate' => $endDate->reveal(),
            ]
        );

        $this->assertEquals('Sulu', $command->getTitle());
    }

    public function testGetDescription()
    {
        $startDate = $this->prophesize(\DateTime::class);
        $endDate = $this->prophesize(\DateTime::class);

        $command = new CreateEventCommand(
            [
                'title' => 'Sulu',
                'description' => 'Sulu is awesome',
                'startDate' => $startDate->reveal(),
                'endDate' => $endDate->reveal(),
            ]
        );

        $this->assertEquals('Sulu is awesome', $command->getDescription());
    }

    public function testGetStartDate()
    {
        $startDate = $this->prophesize(\DateTime::class);
        $endDate = $this->prophesize(\DateTime::class);

        $command = new CreateEventCommand(
            [
                'title' => 'Sulu',
                'description' => 'Sulu is awesome',
                'startDate' => $startDate->reveal(),
                'endDate' => $endDate->reveal(),
            ]
        );

        $this->assertEquals($startDate->reveal(), $command->getStartDate());
    }

    public function testGetEndDate()
    {
        $startDate = $this->prophesize(\DateTime::class);
        $endDate = $this->prophesize(\DateTime::class);

        $command = new CreateEventCommand(
            [
                'title' => 'Sulu',
                'description' => 'Sulu is awesome',
                'startDate' => $startDate->reveal(),
                'endDate' => $endDate->reveal(),
            ]
        );

        $this->assertEquals($endDate->reveal(), $command->getEndDate());
    }
}
