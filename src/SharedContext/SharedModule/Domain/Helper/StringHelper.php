<?php

declare(strict_types=1);

namespace Amoya\Inespay\SharedContext\SharedModule\Domain\Helper;

final class StringHelper
{
    public static function camelToUpperSnake(string $input): string
    {
        return strtoupper(
            preg_replace('/(?<!^)[A-Z]/', '_$0', $input)
        );
    }
}
