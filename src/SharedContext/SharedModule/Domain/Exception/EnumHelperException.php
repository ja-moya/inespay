<?php

declare(strict_types=1);

namespace Amoya\Inespay\SharedContext\SharedModule\Domain\Exception;

class EnumHelperException extends DomainException
{
    public static function enumOptionNotFound(string $enumOption, string $enumClass): self
    {
        return new self(sprintf("%s is not a valid enum option for %s", $enumOption, $enumClass));
    }

    public static function methodNotFound(string $methodName, string $enumClass): self
    {
        return new self(sprintf("%s is not a valid method for %s", $methodName, $enumClass));
    }
}
