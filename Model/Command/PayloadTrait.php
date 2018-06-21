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

trait PayloadTrait
{
    /**
     * @var array
     */
    private $payload;

    public function initializePayload(array $payload): void
    {
        $this->payload = $payload;
    }

    private function getValue(string $name)
    {
        Assert::keyExists($this->payload, $name);

        return $this->payload[$name];
    }

    private function getValueWithDefault(string $name, $default)
    {
        if (!array_key_exists($name, $this->payload)) {
            return $default;
        }

        return $this->payload[$name];
    }

    protected function getStringValue(string $name): string
    {
        $value = $this->getValue($name);

        Assert::string($value);

        return $value;
    }

    protected function getDateTimeValueWithDefault(string $name, ?\DateTime $default = null): ?\DateTime
    {
        $value = $this->getValueWithDefault($name, $default);
        if (!$value) {
            return null;
        }

        Assert::isInstanceOf($value, \DateTime::class);

        return $value;
    }
}
