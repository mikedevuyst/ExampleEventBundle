<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ExampleEventBundle\Tests\Functional\Traits;

use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Sulu\Bundle\ExampleEventBundle\Model\Event;

trait EventTrait
{
    public function createEvent(
        string $title = 'Sulu',
        string $description = 'Sulu is awesome'
    ): Event {
        $event = new Event(Uuid::uuid4()->toString());
        $event->setTitle($title);
        $event->setDescription($description);

        $this->getEntityManager()->persist($event);
        $this->getEntityManager()->flush();

        return $event;
    }

    /**
     * @return EntityManagerInterface
     */
    abstract public function getEntityManager();
}
