<?php

declare(strict_types=1);

namespace Tests\Doubles\SharedContext\SharedModule\Domain\ValueObject;

use Amoya\Inespay\SharedContext\SharedModule\Domain\ValueObject\AbstractValueObject;

class TestValueObject extends AbstractValueObject
{
    public function __construct( protected readonly mixed $value )
    {
    }

    public function value(): mixed
    {
        return $this->value;
    }
}
