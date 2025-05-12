<?php

declare(strict_types=1);

namespace Tests\SharedContext\SharedModule\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use Tests\Doubles\SharedContext\SharedModule\Domain\ValueObject\TestStringValueObject;

class AbstractStringValueObjectTest extends TestCase
{
    public function test_construct(): void
    {
        $value = 'test';
        $stringValueObject = new TestStringValueObject($value);

        $this->assertInstanceOf(TestStringValueObject::class, $stringValueObject);
        $this->assertEquals($value, $stringValueObject->value());
    }
}
