<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ExampleEventBundle\Model\Exception;

class EventNotFoundException extends \Exception
{
    /**
     * @var string
     */
    private $id;

    public function __construct(string $id)
    {
        parent::__construct(sprintf('Event with if "%s" not found', $id));

        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
