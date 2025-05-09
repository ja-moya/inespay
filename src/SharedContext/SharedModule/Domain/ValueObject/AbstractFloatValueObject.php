<?php

declare(strict_types=1);

namespace Amoya\Inespay\SharedContext\SharedModule\Domain\ValueObject;

abstract class AbstractFloatValueObject extends AbstractValueObject
{
    final public function __construct(protected readonly float $value)
    {
        $this->assertValid($value);
    }

    abstract protected function assertValid(float $value): void;

    public function value(): float
    {
        return $this->value;
    }
}
