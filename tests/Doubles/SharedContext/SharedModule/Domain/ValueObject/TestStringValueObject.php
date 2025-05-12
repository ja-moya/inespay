<?php

declare(strict_types=1);

namespace Tests\Doubles\SharedContext\SharedModule\Domain\ValueObject;

use Amoya\Inespay\SharedContext\SharedModule\Domain\ValueObject\AbstractStringValueObject;

class TestStringValueObject extends AbstractStringValueObject
{
    protected function assertValid(string $value): void
    {
    }
}
