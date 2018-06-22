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

class ModifyEventCommand
{
    use PayloadTrait;

    /**
     * @var string
     */
    private $id;

    public function __construct(string $id, array $payload)
    {
        $this->initializePayload($payload);

        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->getStringValue('title');
    }

    public function getDescription(): string
    {
        return $this->getStringValue('description');
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->getDateTimeValueWithDefault('startDate', null);
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->getDateTimeValueWithDefault('endDate', null);
    }
}
