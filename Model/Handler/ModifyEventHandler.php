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

use Sulu\Bundle\ExampleEventBundle\Model\Command\ModifyEventCommand;
use Sulu\Bundle\ExampleEventBundle\Model\Event;
use Sulu\Bundle\ExampleEventBundle\Model\EventRepositoryInterface;

class ModifyEventHandler
{
    /**
     * @var EventRepositoryInterface
     */
    private $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function handle(ModifyEventCommand $command): Event
    {
        $event = $this->eventRepository->findById($command->getId());
        $event
            ->setTitle($command->getTitle())
            ->setDescription($command->getDescription())
            ->setStartDate($command->getStartDate())
            ->setEndDate($command->getEndDate());

        return $event;
    }
}
