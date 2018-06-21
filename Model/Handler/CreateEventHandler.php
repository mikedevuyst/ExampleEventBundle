<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ExampleEventBundle\Model\Handler;

use Sulu\Bundle\ExampleEventBundle\Model\Command\CreateEventCommand;
use Sulu\Bundle\ExampleEventBundle\Model\Event;
use Sulu\Bundle\ExampleEventBundle\Model\EventRepositoryInterface;

class CreateEventHandler
{
    /**
     * @var EventRepositoryInterface
     */
    private $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function handle(CreateEventCommand $command): Event
    {
        $event = $this->eventRepository->create();
        $event
            ->setTitle($command->getTitle())
            ->setDescription($command->getDescription())
            ->setStartDate($command->getStartDate())
            ->setEndDate($command->getEndDate());

        return $event;
    }
}
