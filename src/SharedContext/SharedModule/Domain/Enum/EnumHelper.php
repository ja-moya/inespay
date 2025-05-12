<?php

declare(strict_types=1);

namespace Amoya\Inespay\SharedContext\SharedModule\Domain\Enum;

use Amoya\Inespay\SharedContext\SharedModule\Domain\Exception\EnumHelperException;
use Amoya\Inespay\SharedContext\SharedModule\Domain\Helper\StringHelper;

trait EnumHelper
{
    /**
     * @throws EnumHelperException
     */
    public function __call(string $name, array $arguments): mixed
    {
        if (str_starts_with($name, 'is')) {
            $rawName = substr($name, 2); // e.g., isTwoWords → TwoWords
            $caseName = StringHelper::camelToUpperSnake($rawName); // → TWO_WORDS

            foreach (self::cases() as $case) {
                if ($case->name === $caseName) {
                    return $this === $case;
                }
            }

            throw EnumHelperException::enumOptionNotFound($caseName, static::class);
        }

        throw EnumHelperException::methodNotFound($name, static::class);
    }
}
