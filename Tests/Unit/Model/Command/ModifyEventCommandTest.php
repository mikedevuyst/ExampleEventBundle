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

class ModifyEventCommandTest extends TestCase
{
    public function testGetId()
    {
        $command = new ModifyEventCommand(
            '123-123-123',
            [
                'title' => 'Sulu',
                'description' => 'Sulu is awesome',
                'startDate' => '2018-01-01',
                'endDate' => '2018-12-31',
            ]
        );

        $this->assertEquals('123-123-123', $command->getId());
    }

    public function testGetTitle()
    {
        $command = new ModifyEventCommand(
            '123-123-123',
            [
                'title' => 'Sulu',
                'description' => 'Sulu is awesome',
                'startDate' => '2018-01-01',
                'endDate' => '2018-12-31',
            ]
        );

        $this->assertEquals('Sulu', $command->getTitle());
    }

    public function testGetDescription()
    {
        $command = new ModifyEventCommand(
            '123-123-123',
            [
                'title' => 'Sulu',
                'description' => 'Sulu is awesome',
                'startDate' => '2018-01-01',
                'endDate' => '2018-12-31',
            ]
        );

        $this->assertEquals('Sulu is awesome', $command->getDescription());
    }

    public function testGetStartDate()
    {
        $command = new ModifyEventCommand(
            '123-123-123',
            [
                'title' => 'Sulu',
                'description' => 'Sulu is awesome',
                'startDate' => '2018-01-01',
                'endDate' => '2018-12-31',
            ]
        );

        $this->assertInstanceOf(\DateTime::class, $command->getStartDate());
        $this->assertNotNull($command->getStartDate());
        $this->assertEquals(new \DateTime('2018-01-01'), $command->getStartDate());
    }

    public function testGetEndDate()
    {
        $command = new ModifyEventCommand(
            '123-123-123',
            [
                'title' => 'Sulu',
                'description' => 'Sulu is awesome',
                'startDate' => '2018-01-01',
                'endDate' => '2018-12-31',
            ]
        );

        $this->assertInstanceOf(\DateTime::class, $command->getEndDate());
        $this->assertNotNull($command->getEndDate());
        $this->assertEquals(new \DateTime('2018-12-31'), $command->getEndDate());
    }
}
