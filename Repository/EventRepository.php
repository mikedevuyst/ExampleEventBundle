<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ExampleEventBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\Uuid;
use Sulu\Bundle\ExampleEventBundle\Model\Event;
use Sulu\Bundle\ExampleEventBundle\Model\EventRepositoryInterface;
use Sulu\Bundle\ExampleEventBundle\Model\Exception\EventNotFoundException;

class EventRepository extends EntityRepository implements EventRepositoryInterface
{
    public function create(?string $id = null): Event
    {
        $className = $this->getClassName();

        $event = new $className($id ?: Uuid::uuid4()->toString());
        $this->getEntityManager()->persist($event);

        return $event;
    }

    /**
     * @throws EventNotFoundException
     */
    public function findById(string $id): Event
    {
        /** @var Event $event */
        $event = $this->find($id);

        return $event;
    }

    public function remove(Event $event): void
    {
        $this->getEntityManager()->remove($event);
    }
}
