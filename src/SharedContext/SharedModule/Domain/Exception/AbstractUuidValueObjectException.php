<?php

declare(strict_types=1);

namespace Amoya\Inespay\SharedContext\SharedModule\Domain\Exception;

class AbstractUuidValueObjectException extends DomainException
{
    public static function invalid(string $value, string $enumClass): self
    {
        return new self(sprintf("%s is not a valid value for %s", $value, $enumClass));
    }
}
