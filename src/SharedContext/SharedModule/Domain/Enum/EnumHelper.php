<?php

declare(strict_types=1);

namespace Amoya\Inespay\SharedContext\SharedModule\Domain\Enum;

use Amoya\Inespay\SharedContext\SharedModule\Domain\Exception\EnumHelperException;

trait EnumHelper
{
    /**
     * @throws EnumHelperException
     */
    public function __call(string $name, array $arguments): mixed
    {
        if (str_starts_with($name, 'is')) {
            $caseName = strtoupper(substr($name, 2)); // isFailed → FAILED

            foreach (self::cases() as $case) {
                if ($case->name === $caseName) {
                    return $this === $case;
                }
            }

            throw EnumHelperException::enumOptionNotFound($caseName,static::class);
        }

        throw EnumHelperException::methodNotFound($name, static::class);
    }
}
