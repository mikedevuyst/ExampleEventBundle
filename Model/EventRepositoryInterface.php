<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ExampleEventBundle\Model;

use Sulu\Bundle\ExampleEventBundle\Model\Exception\EventNotFoundException;

interface EventRepositoryInterface
{
    public function create(?string $id = null): Event;

    /**
     * @throws EventNotFoundException
     */
    public function findById(string $id): Event;

    public function remove(Event $event): void;
}
