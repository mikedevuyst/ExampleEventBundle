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

use Webmozart\Assert\Assert;

class ModifyEventCommand
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;

    public function __construct(string $id, array $payload)
    {
        $this->id = $id;

        Assert::keyExists($payload, 'title');
        Assert::string($payload['title']);
        $this->title = $payload['title'];

        Assert::keyExists($payload, 'description');
        Assert::string($payload['description']);
        $this->description = $payload['description'];

        if (array_key_exists('startDate', $payload)) {
            Assert::isInstanceOf($payload['startDate'], \DateTime::class);
            $this->startDate = $payload['startDate'];
        }

        if (array_key_exists('startDate', $payload)) {
            Assert::isInstanceOf($payload['endDate'], \DateTime::class);
            $this->endDate = $payload['endDate'];
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }
}
