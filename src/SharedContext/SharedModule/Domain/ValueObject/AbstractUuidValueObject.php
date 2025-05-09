<?php

declare(strict_types=1);

namespace Amoya\Inespay\SharedContext\SharedModule\Domain\ValueObject;

use Amoya\Inespay\SharedContext\SharedModule\Domain\Exception\AbstractUuidValueObjectException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class AbstractUuidValueObject extends AbstractStringValueObject
{
    public static function generate(): static
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    /**
     * @throws AbstractUuidValueObjectException
     */
    protected function assertValid(string $value): void
    {
        if (!RamseyUuid::isValid($value)) {
            throw AbstractUuidValueObjectException::invalid(var_export($value, true), static::class);
        }
    }
}
