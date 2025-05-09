<?php

declare(strict_types=1);

namespace Amoya\Inespay\SharedContext\SharedModule\Domain\ValueObject;

abstract class AbstractStringValueObject extends AbstractValueObject
{
    final public function __construct(protected readonly string $value)
    {
        $this->assertValid($value);
    }

    abstract protected function assertValid(string $value): void;

    public function value(): string
    {
        return $this->value;
    }
}
