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
    use EventIdTrait;
    use PayloadTrait;

    public function __construct(string $id, array $payload)
    {
        $this->initializeId($id);
        $this->initializePayload($payload);
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
