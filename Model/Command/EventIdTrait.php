<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ExampleEventBundle\Model\Command;

use Sulu\Bundle\ExampleEventBundle\Model\EventId;

trait EventIdTrait
{
    /**
     * @var EventId
     */
    private $id;

    public function initializeId(string $id)
    {
        $this->id = new EventId($id);
    }

    public function getEventId(): EventId
    {
        return $this->id;
    }
}
